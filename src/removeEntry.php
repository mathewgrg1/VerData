<?php
include('connect.php');
mysql_query("delete from hashvalues where hashID=".$_GET['id']);
header("Location: ../history.php");
?>