<?php
header('Content-Type: application/json');


$id= $_POST['staff_id'];

include('../functionPDO.php') ;


$where = array(
    array('id', $id, 'STR'), 
);

   deleterow('staffs',$where);








echo json_encode('Deleted Successfully');

//echo json_encode($cnama);




?>

