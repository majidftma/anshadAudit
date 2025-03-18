<?php



function encrypt_url($string) {
$enable=0;
$password="5";
$string1=$string;
$hex='';
for ($i=0; $i < strlen($string); $i++){
$hex .= dechex(ord($string[$i])+$password);
}

if($enable)
$hexc=$hex;
else
$hexc=$string1;
return $hexc;
};






function decrypt_url($hex) {

$enable=0;
$password="5";
$hex1=$hex;
$string='';
for ($i=0; $i < strlen($hex)-1; $i+=2){
$string .= chr(hexdec($hex[$i].$hex[$i+1])-$password);
}
if($enable)
$stringco=$string;
else
$stringco=$hex1;
return $stringco;  
}; 


function encrypt_url_notuse($string) {

$string1=$string;

  $key = "TKM_321"; //key to encrypt and decrypts.
  $result = '';
  $test = "";
   for($i=0; $i<strlen($string); $i++) {
     $char = substr($string, $i, 1);
     $keychar = substr($key, ($i % strlen($key))-1, 1);
     $char = chr(ord($char)+ord($keychar));

     $test[$char]= ord($char)+ord($keychar);
     $result.=$char;
   }

//return String2Hex(base64_encode($result));

return $string1;

};

function decrypt_url_notuse($string) {

$string1=$string;

 $key = "TKM_321"; //key to encrypt and decrypts.
    $result = '';
 echo $string = base64_decode(Hex2String($string));



   for($i=0; $i<strlen($string); $i++) {
     $char = substr($string, $i, 1);
     $keychar = substr($key, ($i % strlen($key))-1, 1);
     $char = chr(ord($char)-ord($keychar));
     $result.=$char;
   }


 //  return $result;
return $string1;

};


function String2Hex($string){

    $hex='';
    for ($i=0; $i < strlen($string); $i++){
        $hex .= dechex(ord($string[$i]));
    }
    return $hex;
};
 
 
function Hex2String($hex){

    $string='';

 $string .= chr(hexdec($hex[$i].$hex[$i+1]));

    for ($i=0; $i < strlen($hex)-1; $i+=2){
      $string .= chr(hexdec($hex[$i].$hex[$i+1]));
    }


    return $string;
};






?>