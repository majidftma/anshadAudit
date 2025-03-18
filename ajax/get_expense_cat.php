<?php
header('Content-Type: application/json');


$cat= $_POST['cat'];



include('../functionPDO.php') ;



$where=array(array('cat',$cat,'STR'),array('status','1','STR'));
$rows=allrows('expense_cat',$where,'id');


echo json_encode($rows);

//echo json_encode($cnama);




?>

