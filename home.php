<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Cookbook Ordering System</title>
	<!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      body {
        width:100%;
        height:100%;
        min-height:100%;
      }

      .main-page {
        background-color: whitesmoke;
        border-radius: 20px;
        width: 80%;
        height: 630px;
        margin: auto;
      }
      .welcome-text {
        text-align: center;
        margin-top: 60px;
      }
      h2 {
        font-family: "Monaco";
        font-size: 45px;
      }

      img {
        width: 150px;
        margin: auto;
        padding-top: 30px;
        display: block;

      }
      .box {
        margin: 85px auto;
        display: block;
        width: 90px;
        height: 150px;
        transform-style: preserve-3d;
        animation: animate 20s linear infinite;
      }
      @keyframes animate {
        0%
        {
          transform: perspective(1000px) rotateY(0deg);
        }
        100%
        {
          transform: perspective(1000px) rotateY(360deg);
        }
      }
      .box span {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        transform-origin: center;
        transform-style: preserve-3d;
        transform: rotateY(calc(var(--i) * 20deg)) translateZ(400px);
        -webkit-box-reflect: below 0px linear-gradient(transparent, transparent, #0004);
      }
      .box span img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
    </style>
</head>
<body>
	<?php include_once 'nav_bar.php'; ?>

  <div class="main-page">
    <img src="main_logo.png">
    <div class="welcome-text">
      <h2>Welcome to Malzip Cookbook Shop</h2>
    </div>
    <div class="box">
      <span style="--i:1"><img src="products/CB01.jpg"></span>
      <span style="--i:2"><img src="products/CB02.jpg"></span>
      <span style="--i:3"><img src="products/CB03.jpg"></span>
      <span style="--i:4"><img src="products/CB04.jpg"></span>
      <span style="--i:5"><img src="products/CB05.jpg"></span>
      <span style="--i:6"><img src="products/CB06.jpg"></span>
      <span style="--i:7"><img src="products/CB07.jpg"></span>
      <span style="--i:8"><img src="products/CB08.jpg"></span>
      <span style="--i:9"><img src="products/CB09.jpg"></span>
      <span style="--i:10"><img src="products/CB10.jpg"></span>
      <span style="--i:11"><img src="products/CB11.jpg"></span>
      <span style="--i:12"><img src="products/CB12.jpg"></span>
      <span style="--i:13"><img src="products/CB13.jpg"></span>
      <span style="--i:14"><img src="products/CB14.jpg"></span>
      <span style="--i:15"><img src="products/CB15.jpg"></span>
      <span style="--i:16"><img src="products/CB16.jpg"></span>
      <span style="--i:17"><img src="products/CB17.jpg"></span>
      <span style="--i:18"><img src="products/CB18.jpg"></span>
    </div>
  </div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>