<?php
if(isset($_SESSION['user']))
  $name=$_SESSION['user'];
?>
<header style="background-color:#1b1b1b">

  <div class="header-bottom-agileits" >
  <div class="w3-logo">
      <h1><a href="home.php">&nbsp;<i class="fa fa-cubes" aria-hidden="true"></i>VerData</a></h1>
    </div>
  <!-- navigation -->
  <nav class="navbar navbar-default shift" style="background-color: black; ">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>

    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="float: right;">
      <ul class="nav navbar-nav">
      <li><a href="history.php">HI <?php echo $name ?></a></li>
      <li><a href="src/logout_exec.php">Logout</a></li>
      </ul>

    </div><!-- /.navbar-collapse -->

  </nav>
  </div>
  <div class="clearfix"></div>
<!-- //navigation -->
</header>
