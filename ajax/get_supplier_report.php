<?php
header('Content-Type: application/json');

$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
$type = $_POST['type'];
$supplier = $_POST['supplier'];
$branch = $_POST['branch'];

$date = date_create_from_format("d/m/Y", $from_date);
$fromdate = date_format($date, "Y-m-d");

$date = date_create_from_format("d/m/Y", $to_date);
$todate = date_format($date, "Y-m-d");

include('../functionPDO.php');

$where = array(
    array('fromdate', $fromdate, 'STR'),
    array('supplier', $supplier, 'STR')
);

if ($branch != "") {
    array_push($where, array('branch', $branch, 'STR'));
}

$statement = 'SELECT * FROM new_supplier_ledger WHERE ledger_date < :fromdate AND supplier = :supplier';
if ($branch != "") {
    $statement .= ' AND branch = :branch';
}
$rowbal = do_query($statement, $where);

$runbal = 0;

foreach ($rowbal as $rowb) {
    if ($rowb['debit']) {
        $runbal += $rowb['debit'];
    }

    if ($rowb['credit']) {
        $runbal -= $rowb['credit'];
    }
}

$pre_bal = getfield('suppliers', 'sup_id', $supplier, 'INT', 'balance');
$runbal += $pre_bal;

$res = array();
array_push($res, array('day' => '', 'title' => 'Previous Balance', 'narration' => '', 'credit' => '', 'debit' => $runbal, 'runbal' => $runbal));

$where = array(
    array('fromdate', $fromdate, 'STR'),
    array('todate', $todate, 'STR'),
    array('supplier', $supplier, 'STR')
);

if ($branch != "") {
    array_push($where, array('branch', $branch, 'STR'));
}

$statement = 'SELECT DISTINCT ledger_date FROM new_supplier_ledger WHERE ledger_date >= :fromdate AND ledger_date <= :todate AND supplier = :supplier';
if ($branch != "") {
    $statement .= ' AND branch = :branch';
}
$rowdays = do_query($statement, $where);

foreach ($rowdays as $dayr) {
    $where = array(
        array('ledger_date', $dayr['ledger_date'], 'STR'),
        array('supplier', $supplier, 'STR')
    );

    if ($branch != "") {
        array_push($where, array('branch', $branch, 'STR'));
    }

    $statement = 'SELECT * FROM new_supplier_ledger WHERE ledger_date = :ledger_date AND supplier = :supplier';
    if ($branch != "") {
        $statement .= ' AND branch = :branch';
    }
    $rows = do_query($statement, $where);

    foreach ($rows as $row) {
        if ($row['debit']) {
            $runbal += $row['debit'];
        }

        if ($row['credit']) {
            $runbal -= $row['credit'];
        }

        $date = date_create_from_format("Y-m-d", $row['ledger_date']);
        $ledger_date = date_format($date, "d-M-Y");
        array_push($res, array('day' => $ledger_date, 'title' => $row['title'], 'narration' => $row['narration'], 'credit' => $row['credit'], 'debit' => $row['debit'], 'runbal' => $runbal));
    }
}

echo json_encode($res);
?>
