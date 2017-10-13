<?php
session_start();
$_SESSION['fileName']=null;
$_SESSION['timestamp']=null;
$_SESSION['msg']=null;
$_SESSION['fileSize']=null;
$_SESSION['hash_string']=null;
header("Location: ../home.php");
?>