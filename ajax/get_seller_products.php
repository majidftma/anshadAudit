<?php
header('Content-Type: application/json');

include('../functionPDO.php');

include('../get_login.php');

$seller=$userId;
$success=1;


$where = array(
    array('variant', '0', 'INT'),
    array('seller', $seller, 'INT')
              );

$products=array();
$rows=allrows('products',$where,'p_id DESC');

foreach($rows as $row)
{
    $pid=$row['p_id'];
    $code=$row['code'];
    $title=$row['title'];
    $image=$row['image'];
    $display_price=$row['display_price'];
    $price=$row['price'];
    $stock=$row['stock'];
    $shipping_partner_code=$row['shipping_partner'];
    
    if($shipping_partner_code==0)
    $shipping_partner="Manual";
    else
    $shipping_partner=getfield('shipping_charges', 'id', $shipping_partner_code, 'INT', 'name');
    
 array_push($products,
            array(
                'pid'=>$pid,
                'code'=>$code,
                'title'=>$title,
                'image'=>$image,
                'display_price'=>$display_price,
                'price'=>$price,
                'stock'=>$stock,
                'shipping_partner'=>$shipping_partner,
            ));   

}

echo json_encode(array('success'=>$success,'products'=>$products));
//echo json_encode($js_options_array);

?>

