<?php 
date_default_timezone_set("Asia/Bangkok");

//GET PAGE
// $page=$_GET['page'];
// GET PAGE
$page = isset($_GET['page']) ? $_GET['page'] : 'login'; // Default to 'login' if 'page' is not set


//HAndle Sessions
include ('get_login.php');



////INCLUDE PDO and funcntion
include ('functionPDO.php');
include ('main_function.php');
include ('encdecfunc.php');

//Checking Page exists
if($page=="")
$page="login";

//if($page=="login")
//$page=encrypt_url("login");
//$page=decrypt_url($page) ;

$layout0page = array("login","logout","proceed_login");
$layout1page = array("home_page","add_product","edit_product","variant","view_product");

$layout2page = array("pdf_print_html","pdf_print");

if (in_array($page,$layout0page))
$layout=0;

elseif(in_array($page,$layout2page))
$layout=2;


elseif(in_array($page,$layout1page))
$layout=1;


else
{
$page="blacklist";  
$layout=0;
}




//Prepare Lay0ut
if($layout=="1")
include('layout/header.php');

// Layout for logout pages
if($layout=="0")
include('layout_out/header.php');

include('pages/'.$page.'.php');
include('layout/footer.php');

//include ('modal_function.php');

?>