<?php
header('Content-Type: application/json');


$id= $_POST['pay_slip_id'];
$val= $_POST['active_val'];
$sid= $_POST['staff_id'];


include('../functionPDO.php') ;




if($val=='0')
{
$where=  array(array('id',$id,'INT'));
$values=  array(array('active',$val,'INT'));
updaterow('pay_slip', $values, $where); 

}


if($val=='1')
{

$where=  array(array('sid',$sid,'INT'));
$values=  array(array('active','0','INT'));
updaterow('pay_slip', $values, $where); 

    $where=  array(array('id',$id,'INT'));
$values=  array(array('active',$val,'INT'));
updaterow('pay_slip', $values, $where); 

}

//$where = array(array('id', $id, 'STR'), );

//   deleterow('staffs',$where);








echo json_encode('Updated Successfully');

//echo json_encode($cnama);




?>

