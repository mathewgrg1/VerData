<?php
include('connect.php');
session_start();
$_SESSION['msg']=null;
$query= mysql_query("select * from hashvalues where hashString='".$_POST['hash_string']."' and userID=".$_SESSION['userID']);
if(mysql_num_rows($query)==0) {
    $_SESSION['fileName']=null;
    $_SESSION['timestamp']=null;
    $_SESSION['msg']="fail";
}
else {
    $fetch=mysql_fetch_array($query);
    $_SESSION['fileName']=$fetch['fileName'];
    $_SESSION['timestamp']=$fetch['timestamp'];
    $_SESSION['msg']="success";
}
header("Location: ../home.php");
?>
        