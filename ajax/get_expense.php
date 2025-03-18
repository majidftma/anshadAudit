<?php
header('Content-Type: application/json');


$exp_date= $_POST['exp_date'];
$other= $_POST['other'];
$branch= $_POST['branch'];


////
//$exp_date= "20/07/2024";
//$other= "0";
//$branch= "1";


include('../functionPDO.php') ;

$date=date_create_from_format("d/m/Y",$exp_date);
$new_exp_date= date_format($date,"Y-m-d");

$where=array(array('exp_date',$new_exp_date,'STR'),array('branch',$branch,'STR'));

if($other)
$where=array(
    array('cat','other','STR'),
             array('exp_date',$new_exp_date,'STR'),
             array('branch',$branch,'STR')
            );


$rows=allrows('expense',$where,'id');


echo json_encode($rows);

//echo json_encode($cnama);




?>

