<?php
header('Content-Type: application/json');

session_start();
$session_username=$_SESSION['session_username']; 
$session_usereid=$_SESSION['session_user']; 
$session_privilege=$_SESSION['session_privilege']; 


include('../functionPDO.php') ;




$where =array(array('eid',$session_usereid,'STR'));
$row = getrow('sellers', $where);



$finalarray=array('tax'=>$row['tax'],'commission'=>$row['commission']);

echo json_encode($finalarray);

?>

