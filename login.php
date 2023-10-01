<?php

session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("Location: home.php");
}

include_once 'database.php';

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if($_SERVER["REQUEST_METHOD"] == "POST") {
  try {
 
    $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a181765_pt2 where fld_username = :username");
    
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    
    $username = $_POST['username'];
    
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

  }
 
  catch(PDOException $e)
  {
    echo '<script>
    window.onload=function() {
      alert("Login Failed. You have entered an invalid username or password.");
    };
    </script>';
  }

  if($row != null) {
    if($row['fld_password'] == $_POST['upass']) {

      $_SESSION['uid'] = $row['fld_staff_id'];
      $_SESSION['name'] = $row['fld_staff_name'];
      $_SESSION['role'] = $row['fld_role'];
      $_SESSION['loggedin'] = true;

      header("Location: home.php");
    }
    else {
      echo '<script>
      window.onload=function() {
        alert("Login Failed. You have entered an invalid User ID or password.");
      };
      </script>';
    }
  }
  else {
    echo '<script>
    window.onload=function() {
      alert("Login Failed. You have entered an invalid User ID or password.");
    };
    </script>';
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
	<title>Cookbook Ordering System</title>
	<!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
 
    <style>
      body {
        background: url(bg_logo.jpg) no-repeat center center fixed; 
        background-size: cover;
        overflow: hidden;
      }
      img {
        display: block;
        margin: auto;
        width: 70%;
      }
      #container {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto;
        width: 450px;
        height: 470px;
        border-radius: 30px;
        background: rgba(3,3,3,0.25);
        box-shadow: 1px 1px 50px #000;
      }
      #col {
        padding-top: 15px;
      }
      .page-header {
        margin-top: 25px;
      }
      /* Heading */
      h2  {
        font-family: 'Open Sans Condensed', sans-serif;
        text-align: center;
        font-size: 30px;
        color: #ddd;
        text-shadow: 3px 3px 10px #000;
      }

      label {
        font-family: 'Open Sans Condensed', sans-serif;
        text-decoration: none;
        position: relative;
        width: 100%;
        display: block;
        margin: 9px auto;
        font-size: 17px;
        color: #fff;
        padding: 8px;
        border-radius: 6px;
        border: none;
        -webkit-transition: all 2s ease-in-out;
        -moz-transition: all 2s ease-in-out;
        -o-transition: all 2s ease-in-out;
        transition: all 0.2s ease-in-out;
      }
      /* Inputs */
      #userid {
        font-family: 'Open Sans Condensed', sans-serif;
        text-decoration: none;
        position: relative;
        width: 100%;
        display: block;
        margin: 9px auto;
        font-size: 17px;
        color: black;
        padding: 8px;
        border-radius: 6px;
        border: none;
        background: rgba(3,3,3,.1);
        -webkit-transition: all 2s ease-in-out;
        -moz-transition: all 2s ease-in-out;
        -o-transition: all 2s ease-in-out;
        transition: all 0.2s ease-in-out;
      }
      #userpassword {
        font-family: 'Open Sans Condensed', sans-serif;
        text-decoration: none;
        position: relative;
        width: 100%;
        display: block;
        margin: 9px auto;
        font-size: 17px;
        color: black;
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

      #btnlogin {
        font-family: 'Open Sans Condensed', sans-serif;
        text-align: center;
        padding: 4px 8px;
      }

      button:hover{
        opacity: 0.7;
      }
    </style>
</head>
<body>
  <div class="container-fluid" id="container">
  <div class="row">
    <div class="col-xs-10 col-sm-12 col-md-12" id="col">
      <img src="main_logo.png">
      <div class="page-header">
        <h2>Login</h2>
      </div>
      <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form-horizontal">
        
        <!-- Username -->
        <div class="form-group">
          <label for="userid" class="col-sm-3 control-label">Username</label>
          <div class="col-sm-9">
            <input name="username" type="text" class="form-control" id="userid" placeholder="Username" required>
          </div>
        </div>
        
        <!-- Password -->
        <div class="form-group">
          <label for="userpassword" class="col-sm-3 control-label">Password</label>
          <div class="col-sm-9">
            <input name="upass" type="password" class="form-control" id="userpassword" placeholder="User Password" required>
          </div>
        </div>

        <!-- Login Button -->
        <div class="form-group">
          <div class="col-sm-offset-5 col-sm-9">
            <button class="btn btn-default" type="submit" name="login" id="btnlogin">Login</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>