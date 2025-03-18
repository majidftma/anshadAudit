<?php
header('Content-Type: application/json');

include('../functionPDO.php');


$pid=$_POST['pid'];
$product_id=$_POST['p_id'];

$succes=1;


$where = array(array('p_id', $pid, 'INT'));
$product = getrow('products', $where);
$default=0;
if($product['variant_default']=="1")
$default=1;



$where_variants = array(array('variant_parent', $product_id, 'INT'));
$option_rows=allrows('products',$where_variants,'p_id');    
$js_options_array = [];
  $count=0;        
foreach ($option_rows as $row) {
    $js_options_array[] = [
        'option_name' => $row['title'],
        'option_link' => $row['p_id'],
    ];
    $count++;
}

if($count>1 && $default==1)
$succes=0;
else
{
deleterow('products', $where);
   $where_variants = array(array('variant_parent', $product_id, 'INT'));
$option_rows=allrows('products',$where_variants,'p_id');    
$js_options_array = [];
  $count=0;        
foreach ($option_rows as $row) {
    $js_options_array[] = [
        'option_name' => $row['title'],
        'option_link' => $row['p_id'],
    ];
    $count++;
}
} 
// Encode the PHP array to JSON format for JavaScript
//$js_options_array = json_encode($js_options_array); 


echo json_encode(array('success'=>$succes,'array_option'=>$js_options_array));
//echo json_encode($js_options_array);

?>

