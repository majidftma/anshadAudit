<?php


header('Content-Type: application/json');


include('../functionPDO.php') ;




// Check if both 'p_id' and 'product_status' are set in the POST request
if (isset($_POST['p_id']) && isset($_POST['status'])) {
    $productId = $_POST['p_id'];
    $status = $_POST['status'];



    
    $value=array(array('product_status',$status,'INT'));
     $where=array(array('p_id',$productId,'INT'));
     updaterow('products', $value, $where);
    
    
   echo json_encode(['product_status' => 'success']);
    
    
} else {
    echo json_encode(['product_status' => 'error', 'message' => 'Invalid parameters']);
}
?>

