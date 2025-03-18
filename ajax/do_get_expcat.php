<?php
header('Content-Type: application/json');


$id= $_POST['id'];



include('../functionPDO.php') ;




$where=array(array('id',$id,'INT'));
$row=getrow('expense_cat',$where);

if($row[status]=='1')
$value=array(array('status','0','INT'));

if($row[status]=='0')
$value=array(array('status','1','INT'));

	
updaterow('expense_cat',$value,$where);	

$result=getrow('expense_cat',$where);



echo json_encode($result);

//echo json_encode($cnama);




?>

