<?php
header('Content-Type: application/json');

session_start();
$session_username=$_SESSION['session_username']; 
$session_usereid=$_SESSION['session_user']; 
$session_privilege=$_SESSION['session_privilege']; 


include('../functionPDO.php') ;


$weight=$_POST['weight'];
$width=$_POST['width'];
$height=$_POST['height'];
$length=$_POST['length'];
$id=$_POST['id'];

$where =array(array('eid',$session_usereid,'STR'));
$row = getrow('sellers', $where);

$where =array(array('id',$id,'STR'));
$row_courier = getrow('shipping_charges', $where);

$pincode = urlencode($row['pincode']);  
$courier_id = urlencode($row_courier['courier_id']);  


$data = [
    "pincode" => $pincode,
    "courier_id" => $courier_id,
    "weight" => $weight,
    "length" => $length,
    "height" => $height,
    "width" => $width,
];

$update_url = "https://ecommerce.ryzon.in/check_pickup.php";
    
$ch = curl_init();   
curl_setopt_array($ch, [
    CURLOPT_URL => $update_url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ],
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_SSL_VERIFYHOST => 0, // Disable SSL host verification
    CURLOPT_SSL_VERIFYPEER => 0, // Disable SSL peer verification
]);

$response = curl_exec($ch);
$response_arr = json_decode($response, true);
curl_close($ch);


//$finalarray=array('pincode'=>$row['pincode']);

echo json_encode($response_arr);

?>

