<?php
  include('connect.php');
    $query=mysql_query("select * from users where email='".$_POST['email']."' and password='".$_POST['password']."'");
    $rows = mysql_num_rows($query);
    if($rows==0) {
      $error = 'Login Id or Password is incorrect !!';
			header('Location: ../index.php?msg=loginFailed');
    }
    else {
        $fetch=mysql_fetch_array($query);
        session_start();
        $_SESSION['user'] = $fetch['fullName'];
        $_SESSION['userID'] = $fetch['userID'];
        header('Location: ../home.php');
    }

?>