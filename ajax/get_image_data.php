<?php
header('Content-Type: application/json');


$imageid= $_GET['image_id'];
//$imageid="12uxnWWSiC4soMnA9vBzLzdqMOdFu8CwA";
$base64Image = getImageBase64("https://drive.google.com/uc?export=view&id=".$imageid);


//echo json_encode($base64Image);
//echo $base64Image;
//echo 'data:image/png;base64,' . $base64Image;
header('Content-Type: image/png'); 
echo $base64Image;
function getImageBase64($imageUrl) {
    $imageData = file_get_contents($imageUrl);
    //$base64 = base64_encode($imageData);
    return $imageData;
}

?>

