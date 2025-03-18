<?php
header('Content-Type: application/json');

session_start();
$session_username=$_SESSION['session_username']; 
$session_usereid=$_SESSION['session_user']; 
$session_privilege=$_SESSION['session_privilege']; 


include('../functionPDO.php') ;





$rows = allrows('shipping_charges', '1','id');


$finalarray=array();
foreach($rows as $row)
{

array_push($finalarray,
           array('id'=>$row['id'],
                'name'=>$row['name'],
                'image'=>$row['image'],
                'state'=>$row['state'],
                'other_state'=>$row['other_state'],
                'additional_state'=>$row['additional_state'],
                'additional_other_state'=>$row['additional_other_state']
                )
          );    
}

echo json_encode($finalarray);

?>

