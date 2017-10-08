<?php
include('connect.php');
$email = $_POST['email'];
$fullName = $_POST['fullName'];
$password = $_POST['password'];
$query = mysql_query("select email from users where email='".$email."'");
if(mysql_num_rows($query)!=0)
    header("Location: ../index.php?msg=emailExists");
else {
    mysql_query("insert into users (fullName, email, password) values('".$fullName."','".$email."','".$password."')");
    header("Location: ../index.php?msg=registrationSuccessful");
}
?>