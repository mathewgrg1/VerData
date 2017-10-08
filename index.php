
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<?php
session_start();
if (isset($_SESSION['user']))
    header("Location: home.php");

 ?>
<!DOCTYPE html>
<html>
<head>
    <title>VerData</title>
		<meta charset="utf-8">
		<link href="css/style.css" rel='stylesheet' type='text/css' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!--webfonts-->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text.css'/>
		<!--//webfonts-->
    <script type="text/javascript">
        var validateForm = function() {
            var pwd = document.getElementById('password');
            var cnfPwd = document.getElementById('cnfPassword');
            var email = document.getElementById('email');
            var fullName = document.getElementById('fullName');
            var regName = /^[a-z ,.'-]+$/i;
            var regEmail = /^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
            var flag = true;
            if(!regName.test(fullName.value)) {
                document.getElementById('fullNameA').className = 'icon into';
                fullName.focus();
                flag = false;
            }
            else {
                document.getElementById('fullNameA').className = 'icon ticker';
                flag = true;
            }
            if(!regEmail.test(email.value)) {
                document.getElementById('emailA').className = 'icon into';
                email.focus();
                flag = false;
            } 
            else {
                document.getElementById('emailA').className = 'icon ticker';
                flag = true;
            } 
            if(pwd.value.length < 6) {
                document.getElementById('pwdA').className = 'icon into';
                pwd.focus();
                flag = false;
            }
            else {
                document.getElementById('pwdA').className = 'icon ticker';
                flag = true;
            }
            if(pwd.value != cnfPwd.value) {
                document.getElementById('cPwdA').className = 'icon into';
                cnfPwd.focus();
                flag = false;
            }
            else {
                document.getElementById('cPwdA').className = 'icon ticker';
                flag = true;
            }
            return flag;
        }
    </script>
</head>
<body>
	<div class="main">
		<div class="header" >
			<h1>Login or Create a Free Account!</h1>
		</div>
			<form action="src/register_exec.php" method="post" name="register">
				<ul class="left-form">
					<h2>New Account:</h2>
					<li>
						<input type="text" placeholder="Full Name" id="fullName" name="fullName" required/>
                        <a href="#" class="icon ticker" id="fullNameA"> </a>
						<div class="clear"> </div>
					</li> 
					<li>
						<input type="text" placeholder="Email" id="email" name="email" required/>
						<a href="#" class="icon ticker" id="emailA"> </a>
						<div class="clear"> </div>
					</li>
					<li>
						<input type="password" placeholder="Password" id="password" name="password" required/>
						<a href="#" class="icon ticker" id="pwdA"> </a>
						<div class="clear"> </div>
					</li>
					<li>
						<input type="password" placeholder="Confirm Password" id="cnfPassword" name="cnfPassword" required/>
						<a href="#" class="icon ticker" id="cPwdA"> </a>
						<div class="clear"> </div>
					</li> 
					<label class="checkbox"><input type="checkbox" name="checkbox" required><i> </i>I agree to the terms and conditions of VerData</label>
					<input type="submit" onclick="return validateForm()" value="Create Account">
						<div class="clear"> </div>
				</ul>
        </form>
        <form action="src/login_exec.php" method="post" name="login">
				<ul class="right-form">
					<h3>Login:</h3>
					<div>
						<li><input type="text"  placeholder="Email" name="email" required/></li>
						<li> <input type="password"  placeholder="Password" name="password" required/></li>
						<h4>I forgot my Password!</h4>
							<input type="submit" onclick="myFunction()" value="Login" >
					</div>
					<div class="clear"> </div>
				</ul>
				<div class="clear"> </div>
					
			</form>
			
		</div>	
</body>
</html>

    <?php
    $req=isset($_REQUEST['msg']) ? $_REQUEST['msg'] :'';
    if($req=='emailExists') {
            ?>
        <script>
            document.getElementById('emailA').className = 'icon into';
            alert("Email already in use. Try clicking 'I forgot my Password!'");
    </script>
<?php
    }
    if($req=='registrationSuccessful') {
        ?>
<script>
        alert("Registration successful. Please login...");
    </script>   
<?php
    }
if($req=='loginFailed') {
        ?>
<script>
        alert("Invalid credentials. Please try again...");
    </script>   
<?php
    }
    ?>