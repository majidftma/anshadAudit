<?php
header('Content-Type: application/json');


$id= $_POST['id'];

include('../functionPDO.php') ;


$where = array(
    array('id', $id, 'STR'), 
);

   deleterow('salary_payments_manual',$where);

$where = array(
    array('xid', $id, 'STR'), array('tabl', 'salary_payments_manual', 'STR'), 
);

   deleterow('company_ledger',$where);








echo json_encode('Deleted Successfully');

//echo json_encode($cnama);




?>

