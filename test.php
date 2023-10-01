<?php

session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("Location: index.php");
}

include_once 'database.php';

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if($_SERVER["REQUEST_METHOD"] == "POST") {
  try {
 
    $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a182843_pt2 where fld_staff_id = :uid");
    $stmt->bindParam(':uid', $uid, PDO::PARAM_STR);
    $uid = $_POST['uid'];
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

  }
 
  catch(PDOException $e)
  {
    echo '<script>alert("Login Failed. You have entered an invalid User ID or password.");</script>';
  }

  if($row != null) {
    if($row['fld_staff_password'] == $_POST['upass']) {

      $_SESSION['uid'] = $row['fld_staff_id'];
      $_SESSION['fname'] = $row['fld_staff_fname'];
      $_SESSION['lname'] = $row['fld_staff_lname'];
      $_SESSION['userlevel'] = $row['fld_staff_userlvl'];
      $_SESSION['loggedin'] = true;

      header("Location: index.php");
    }
    else {
      echo '<script>alert("Login Failed. You have entered an invalid User ID or password.");</script>';
    }
  }
  

}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>FridgeCare Ordering System</title>
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
    html {
      background: url(http://cdn.magdeleine.co/wp-content/uploads/2014/05/3jPYgeVCTWCMqjtb7Dqi_IMG_8251-1400x933.jpg) no-repeat center center fixed; 
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
      overflow: hidden;
    }

    img {
      display: block;
      margin: auto;
      width: 100%;
      height: auto;
    }

    #login-button{
      cursor: pointer;
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      padding: 30px;
      margin: auto;
      width: 100px;
      height: 100px;
      border-radius: 50%;
      background: rgba(3,3,3,.8);
      overflow: hidden;
      opacity: 0.4;
      box-shadow: 10px 10px 30px #000;
    }

    /* Login container */
    #container {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      margin: auto;
      width: 260px;
      height: 260px;
      border-radius: 5px;
      background: rgba(3,3,3,0.25);
      box-shadow: 1px 1px 50px #000;
      display: none;
    }

    /* Heading */
    h1{
      font-family: 'Open Sans Condensed', sans-serif;
      position: relative;
      margin-top: 0px;
      text-align: center;
      font-size: 40px;
      color: #ddd;
      text-shadow: 3px 3px 10px #000;
    }

    /* Inputs */
    a,
    input {
      font-family: 'Open Sans Condensed', sans-serif;
      text-decoration: none;
      position: relative;
      width: 80%;
      display: block;
      margin: 9px auto;
      font-size: 17px;
      color: ;color: #fff;
      padding: 8px;
      border-radius: 6px;
      border: none;
      background: rgba(3,3,3,.1);
      -webkit-transition: all 2s ease-in-out;
      -moz-transition: all 2s ease-in-out;
      -o-transition: all 2s ease-in-out;
      transition: all 0.2s ease-in-out;
    }

    input:focus{
      outline: none;
      box-shadow: 3px 3px 10px #333;
      background: rgba(3,3,3,.18);
    }

    /* Placeholders */
    ::-webkit-input-placeholder {
      color: #ddd;
    }
    :-moz-placeholder {
      /* Firefox 18- */
      color: red;
    }
    ::-moz-placeholder {
      /* Firefox 19+ */
      color: red;
    }
    :-ms-input-placeholder {
      color: #333;
    }

    /* Link */
    a {
      font-family: 'Open Sans Condensed', sans-serif;
      text-align: center;
      padding: 4px 8px;
      background: rgba(107,255,3,0.3);
    }

    a:hover{
      opacity: 0.7;
    }

  </style>
</head>
<body>
  <div id="login-button">
    <img src="logo-pic.png"></img>
  </div>
  <div id="container">
    <h1>Log In</h1>
    <form>
      <input type="email" name="email" placeholder="E-mail">
      <input type="password" name="pass" placeholder="Password">
      <a href="#">Log in</a>
    </form>
  </div>
</body>
</html>
<script>
    $('#login-button').click(function(){
      $('#login-button').fadeOut("slow",function(){
        $("#container").fadeIn();
        TweenMax.from("#container", .4, { scale: 0, ease:Sine.easeInOut});
        TweenMax.to("#container", .4, { scale: 1, ease:Sine.easeInOut});
      });
    });
</script>