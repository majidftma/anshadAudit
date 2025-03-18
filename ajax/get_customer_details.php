<?php
header('Content-Type: application/json');


$cid= $_POST['cid'];
$dopage= $_POST['dopage'];

include('../functionPDO.php') ;


if($dopage=="customer")
{
$where=array(array('cid',$cid,'STR'));
$row=getrow('customers',$where);
}


if($dopage=="supplier")
{
$where=array(array('sup_id',$cid,'STR'));
$row=getrow('suppliers',$where);
}

if($dopage=="product")
{
$where=array(array('pid',$cid,'STR'));
$row=getrow('products',$where);
}


echo json_encode($row);

//echo json_encode($cnama);




?>

