<?php


session_start();
$loggedin = $_SESSION['loggedin'] ?? null;
$userId = $_SESSION['session_user'] ?? null;
$username = $_SESSION['session_username'] ?? null;
$privilege = $_SESSION['session_privilege'] ?? null;


if($loggedin!="true" && $page!="proceed_login")
$page="login";
?>

