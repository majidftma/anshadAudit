<?php
header('Content-Type: application/json');


$branch= $_POST['branch'];
$supplier= $_POST['supplier'];
$mon= $_POST['mon'];
$year= $_POST['year'];


//$branch= "0";
//$supplier= "0";
//$mon= "0";
//$year= "0";

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




if ($supplier != "0") {
    $supplierCondition = "supplier = $supplier";
    array_push($where, $supplierCondition);
}

if ($branch != "0") {
    $branchCondition = "branch = $branch";
    array_push($where, $branchCondition);
}





//
//if ($branch != "0") {
//    array_push($where, array("branch", $branch, 'STR'));
//}
//
//
//if ($supplier != "0") {
//    array_push($where, array("supplier", $supplier, 'STR'));
//}

$whereClause = "";
if (!empty($where)) {
    $whereClause = "WHERE " . implode(" AND ", $where);
}

// Construct the SQL statement
$statement = "SELECT * FROM daily_purchase $whereClause ORDER BY id";

// Execute the query using the do_query function
$rows = do_query($statement, $where);



$rownum=sizeof($rows);

for($i=0;$i<$rownum;$i++)
    
   {
$rows[$i]['branch']=getfield('branch','id',$rows[$i]
                             ["branch"],'INT','name');


//for($i=0;$i<$rownum;$i++)
$rows[$i]['supplier']=getfield('suppliers','sup_id',$rows[$i]["supplier"],'INT','name');
}
echo json_encode($rows);

//echo json_encode($cnama);




?>

