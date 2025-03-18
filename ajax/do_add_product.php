<?php
header('Content-Type: application/json');

// Fetching values from POST
$price = $_POST['price'];
$discount = $_POST['discount'];
$commission = $_POST['commission'];
$shipping_charge = $_POST['shipping_charge'];
$tax = $_POST['tax'];

// Log the received data for debugging
error_log("Received data: " . print_r($_POST, true));

// Include the functionPDO.php which contains the insertrow function
include('../functionPDO.php');

// Preparing the values array for insertion
$value = array(
    array('price', $price, 'STR'),
    array('discount', $discount, 'STR'),
    array('commission', $commission, 'STR'),
    array('shipping_charge', $shipping_charge, 'STR'),
    array('tax', $tax, 'STR'),
    
);

// Log the values array for debugging
error_log("Values for insertion: " . print_r($value, true));

// Insert row into 'partys' table
$iid = insertrow('products', $value);

// Return the inserted ID as a JSON response
if ($iid) {
    echo json_encode(array('success' => true, 'message' => 'Added successfully', 'p_id' => $iid));
} else {
    echo json_encode(array('success' => false, 'message' => 'Failed to add'));
}


?>







