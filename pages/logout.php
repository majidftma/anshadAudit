<div>
<?php 
session_start();
session_destroy();

$logpage=encrypt_url('login');
header("Location: ".$logpage);
echo "<script>window.location.href ='".$logpage."';</script>"; 

 
?>

</div>