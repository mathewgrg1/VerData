<?php
include('connect.php');
session_start();
$fileName=$_POST['fileName'];
$fileSize=$_POST['fileSize'];
$hashString=$_POST['hash_string'];
$userID=$_SESSION['userID'];
$query= mysql_query("select * from hashvalues where hashString='".$_POST['hash_string']."' and userID=".$_SESSION['userID']);
if(mysql_num_rows($query)==0) {
    mysql_query("insert into hashvalues (fileName, fileSize, hashString, userID) values('".$fileName."',".$fileSize.",'".$hashString."','".$userID."')") or die(mysql_error());
    $_SESSION['fileName']=$fileName;
    $_SESSION['msg']="saved";
}
else {
    $fetch=mysql_fetch_array($query);
    $_SESSION['fileName']=$fetch['fileName'];
    $_SESSION['timestamp']=$fetch['timestamp'];
    $_SESSION['msg']="alreadyExists";
}
$_SESSION['fileSize']=$fileSize;
$_SESSION['hash_string']=$hashString;
header("Location: ../home.php");
?>