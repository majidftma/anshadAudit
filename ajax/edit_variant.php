<?php
header('Content-Type: application/json');
include('../functionPDO.php');

$success=1;


$variant_title = trim($_POST['variant_title']);
$title = trim($_POST['title']);
$product_id = (int) $_POST['p_id'];

if(!$product_id)
$success=0;

$where = [['p_id', $product_id, 'INT']];
$value = array(
    array('title', $title, 'STR'),
    array('variant_title', $variant_title, 'STR'),
              );

updaterow('products', $value, $where);

if ($success) {
    echo json_encode(['success' => 1]);
} else {
    echo json_encode(['error' => 'Update failed']);
}

exit;
?>
