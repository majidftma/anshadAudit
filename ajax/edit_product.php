<?php
header('Content-Type: application/json');

include('../functionPDO.php');


$currentTime = date("Y-m-d H:i:s");
$currenttime = date("d-m-Y H:i:s");

$pid=$_POST['pid'];
$title=$_POST['title'];
$short_descr=$_POST['short_descr'];
$price=$_POST['price'];
$discount=$_POST['discount'];
$tax=$_POST['tax'];
$commission=$_POST['commission'];
$totalPrice=$_POST['totalPrice'];
$ship_setting=$_POST['ship_setting'];
$ship_manual_charge=$_POST['ship_manual_charge'];
$ship_weight=$_POST['ship_weight'];
$ship_length=$_POST['ship_length'];
$ship_width=$_POST['ship_width'];
$ship_height=$_POST['ship_height'];
$shipping_partner=$_POST['shipping_partner'];
$shipping_charge=$_POST['shipping_charge'];
$display_price=$_POST['display_price'];
$noshippingcharge=$_POST['noshippingcharge'];
$qty_name=$_POST['qty_name'];
$qty_list=$_POST['qty_list'];
$stock=$_POST['stock'];
$highlights=$_POST['highlights'];
$product_status=$_POST['product_status'];
$image=$_POST['image'];
$images_json=json_decode($_POST['images'], true);

 $where = array(array('p_id', $pid, 'INT'));
 $value = array(
array('title', $title, 'STR'),
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
array('product_status', $product_status, 'STR'),
array('image', $image, 'STR'),
     
array('last_edit', $currentTime, 'STR'),
             
          );
    
 updaterow('products', $value, $where);


$where = array(array('pid', $pid, 'INT'));
deleterow('product_images', $where);
foreach ($images_json as $image) {
$image_link = $image['image_link'];
if (!empty($image_link)) {
$imageValues = [
          array('pid', $pid, 'INT'),
          array('image_link', $image_link, 'STR'),
          
              ];
 $product_id=    insertrow('product_images', $imageValues);
  }
}


$where_variant=array(
    array('variant_parent', $pid, 'INT'),
    array('variant_default', '1', 'INT'),
);
$row_variant=getrow('products',$where_variant);
if($row_variant)
{
$where = array(
    array('p_id', $row_variant['p_id'], 'INT')); 
 
 $variant_title=$title.'('.$row_variant["variant_title"].')';   
     $value = array(
array('title', $variant_title, 'STR'),
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
array('image', $image, 'STR'),
     
             
          );
    
 updaterow('products', $value, $where);
    
    
}

echo json_encode(array('success'=>1,'time'=>$currenttime));

?>

