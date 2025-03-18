<?php
header('Content-Type: application/json');
include('../functionPDO.php');




$product_id = $_POST['pid'];

$where = array(array('variant_parent', $product_id, 'INT'));
$option_rows=allrows('products',$where,'p_id'); 

if($option_rows)
$default=0;
else
$default=1;

$where = array(array('p_id', $product_id, 'INT'));
$product = getrow('products', $where);



// Extract product data
$title = $product['title'];
$code= $product['code'];


$short_descr = $product['short_descr'];
$price = $product['price'];
$discount = $product['discount'];
$commission = $product['commission'];
$shipping_charge = $product['shipping_charge'];
$ship_setting = $product['ship_setting'];
$ship_weight = $product['ship_weight'];
$ship_length = $product['ship_length'];
$ship_width = $product['ship_width'];
$ship_height = $product['ship_height'];
$ship_manual_charge = $product['ship_manual_charge'];
$tax = $product['tax'];
$display_price = $product['display_price'];
$noshippingcharge = $product['noshippingcharge'];
 
$quantity = $product['qty_name'];
$available_values = $product['qty_list'];
$description = $product['highlights'];
$stock = $product['stock'];
$image = $product['image'];
$product_status = $product['product_status'];

$totalPrice = $product['totalPrice'];
$shipping_partner = $product['shipping_partner'];
$qty_list = $product['qty_list']; 
$qty_name = $product['qty_name']; 
$highlights = $product['highlights']; 




 $value = array(
array('title', $title, 'STR'),
array('code', $code, 'STR'),
array('short_descr', $short_descr, 'STR'),
array('price', $price, 'STR'),
array('discount', $discount, 'STR'),
array('commission', $commission, 'STR'),
array('tax', $tax, 'STR'),
array('totalPrice', $totalPrice, 'STR'),
array('ship_setting', $ship_setting, 'STR'),
array('ship_manual_charge', $ship_manual_charge, 'STR'),
array('ship_weight', $ship_weight, 'STR'),
array('ship_length', $ship_length, 'STR'),
array('ship_width', $ship_width, 'STR'),
array('ship_height', $ship_height, 'STR'),
array('shipping_partner', $shipping_partner, 'STR'),
array('shipping_charge', $shipping_charge, 'STR'),
array('display_price', $display_price, 'STR'),
array('noshippingcharge', $noshippingcharge, 'STR'),
array('qty_list', $qty_list, 'STR'),
array('qty_name', $qty_name, 'STR'),
array('stock', $stock, 'STR'),
array('highlights', $highlights, 'STR'),
array('product_status', '1', 'STR'),
array('image', $image, 'STR'),
array('variant', '1', 'INT'),
array('variant_parent', $product_id, 'INT'),
array('variant_default', $default, 'INT'),
     
             
          );


 $productid = insertrow('products', $value);
//if ($success) {
//    echo json_encode(['success' => 1]);
//} else {
//    echo json_encode(['error' => 'Update failed']);
//}

echo json_encode(['pid' => $productid]);

exit;
?>
