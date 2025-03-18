<?php
header('Content-Type: application/json');


$branch= $_POST['branch'];
$customer= $_POST['customer'];
$mon= $_POST['mon'];
$year= $_POST['year'];


//$branch= "1";
//$mon= "8";
//$year= "2024";

include('../functionPDO.php') ;



$where=array();
if ($year != "0") {
    $yearCondition = "YEAR(entry_date) = $year";
    array_push($where, $yearCondition);
}

if ($mon != "0") {
    $monCondition = "MONTH(entry_date) = $mon";
    array_push($where, $monCondition);
}


if ($customer != "0") {
    $customerCondition = "customer = $customer";
    array_push($where, $customerCondition);
}

if ($branch != "0") {
    $branchCondition = "branch = $branch";
    array_push($where, $branchCondition);
}

$whereClause = "";
if (!empty($where)) {
    $whereClause = "WHERE " . implode(" AND ", $where);
}

// Construct the SQL statement
$statement = "SELECT * FROM payment_sale $whereClause ORDER BY id";

//echo $statement;
// Execute the query using the do_query function
$rows = do_query($statement, $where);



$rownum=sizeof($rows);

for($i=0;$i<$rownum;$i++)
{
$rows[$i]['branch']=getfield('branch','id',$rows[$i]["branch"],'INT','name');
$rows[$i]['customer']=getfield('customers','cid',$rows[$i]["customer"],'INT','name');
}
echo json_encode($rows);

//echo json_encode($cnama);




?>

