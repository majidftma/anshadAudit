<?php
header('Content-Type: application/json');

include('../functionPDO.php');



$product_id=$_POST['p_id'];

$succes=1;





$where_variants = array(array('variant_parent', $product_id, 'INT'));
$option_rows=allrows('products',$where_variants,'p_id');    
$js_options_array = [];
  $count=0;        
foreach ($option_rows as $row) {
    $js_options_array[] = [
        'option_name' => $row['variant_title'],
        'option_link' => $row['p_id'],
    ];
    $count++;
}


echo json_encode(array('success'=>$succes,'array_option'=>$js_options_array));
//echo json_encode($js_options_array);

?>

