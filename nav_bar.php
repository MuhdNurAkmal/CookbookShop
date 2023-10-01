<?php

session_start();

if(empty($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
}

?>
<style>
  body {
    background: url(bg_logo.jpg) no-repeat;
    background-size: cover;
    background-color: grey;
    background-blend-mode: multiply;
  }
  img {
    width: 20%;
  }
  .navbar {
    background: #F1DBBF;
  }
  #fcbrand {
    background: #F1DBBF;
    color: #AA5656;
  }
  #fcbrand:hover {
    color: #A8A8A8;
  }
  #home {
    background: #F1DBBF;
    color: #AA5656;
  }
  #home:hover {
    color: #A8A8A8;
  }
  #usernamedd {
    background: #F1DBBF;
    color: #AA5656;
  }
  #usernamedd:hover {
    color: #A8A8A8;
  }
</style>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="home.php" id="fcbrand">Cookbook</a>
    </div>
 
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li><a href="home.php" id="home">Home</a></li>
    </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <?php if($_SESSION["name"]) { ?>
          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="usernamedd"><?php echo $_SESSION['name']; ?> <span class="caret"></span></a>
          <?php } ?>
          <ul class="dropdown-menu">
            <li><a style="font-weight: bold;">Role : <?php echo $_SESSION['role']; ?></a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="customers.php">Customers</a></li>
            <li><a href="staffs.php">Staffs</a></li>
            <li><a href="orders.php">Orders</a></li>
            <li><a href="logout.php">Log out</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>