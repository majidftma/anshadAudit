<?php
header('Content-Type: application/json');

$from_date= $_POST['from_date'];
$to_date= $_POST['to_date'];
$type= $_POST['type'];
$customer= $_POST['customer'];
$branch= $_POST['branch'];

$date = date_create_from_format("d/m/Y", $from_date);
$fromdate = date_format($date, "Y-m-d");

$date = date_create_from_format("d/m/Y", $to_date);
$todate = date_format($date, "Y-m-d");

include('../functionPDO.php');

$where = array(
    array('fromdate', $fromdate, 'STR'),
    array('todate', $todate, 'STR')
);

$st1 = "";

if ($customer != "") {
    array_push($where, array('customer', $customer, 'STR'));
    $st1 .= " AND customer = :customer";
}

if ($branch != "") {
    array_push($where, array('branch', $branch, 'STR'));
    $st1 .= " AND branch = :branch";
}

$statement = 'SELECT DISTINCT entry_date FROM daily_sale WHERE entry_date >= :fromdate AND entry_date <= :todate' . $st1;
$rowdays = do_query($statement, $where);

$res = array();
foreach ($rowdays as $dayr) {
    $where = array(
        array('entry_date', $dayr['entry_date'], 'STR')
    );

    if ($customer != "") {
        array_push($where, array('customer', $customer, 'STR'));
    }

    if ($branch != "") {
        array_push($where, array('branch', $branch, 'STR'));
    }

    $statement = 'SELECT * FROM daily_sale WHERE entry_date = :entry_date';
    
    if ($customer != "") {
        $statement .= " AND customer = :customer";
    }
    
    if ($branch != "") {
        $statement .= " AND branch = :branch";
    }

    $rows = do_query($statement, $where);

    $sale = 0;
    $payment = 0;
    $i = 0;
    foreach ($rows as $row) {
        $sale += $row['total_amount'];
        $payment += $row['amount_paid'];
        $i++;
    }

    $date = date_create_from_format("Y-m-d", $row['entry_date']);
    $entry_date = date_format($date, "d-M-Y");
    array_push($res, array('day' => $entry_date, 'sale' => $sale, 'payment' => $payment, 'count' => $i));
}

echo json_encode($res);
?>
