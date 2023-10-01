<?php

session_start();

if(empty($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
}
  include_once 'database.php';
?>
<?php
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT * FROM tbl_orders_a181765, tbl_staffs_a181765_pt2, tbl_customers_a181765_pt2, tbl_orders_details_a181765 WHERE tbl_orders_a181765.fld_staff_id = tbl_staffs_a181765_pt2.fld_staff_id AND tbl_orders_a181765.fld_cust_id = tbl_customers_a181765_pt2.fld_cust_id AND tbl_orders_a181765.fld_order_num = tbl_orders_details_a181765.fld_order_num AND tbl_orders_a181765.fld_order_num = :oid");
  $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
  $oid = $_GET['oid'];
  $stmt->execute();
  $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
}
catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Invoice | Cookbook Ordering System</title>
  <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <style type="text/css">
      th {
        background-color: lightblue;
      }
    </style>

 
</head>
<body>

<div class="row">
  <div class="col-xs-6">
    <br>
    <img src="main_logo.png" width="60%" height="60%">
  </div>
  <div class="col-xs-6 text-right">
    <h1>INVOICE</h1>
    <h5>Order: <?php echo $readrow['fld_order_num'] ?></h5>
    <h5>Date: <?php echo $readrow['fld_order_date'] ?></h5>
  </div>
</div>
<hr>
<div class="row">
  <div class="col-xs-5">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>From: Malzip Cookbook Shop</h4>
      </div>
      <div class="panel-body">
        <p>
        Blok H, Kolej Pendeta Za'ba<br>
        Universiti Kebangsaan Malaysia<br>
        43600 Bangi<br>
        Selangor Darul Ehsan<br>
        </p>
      </div>
    </div>
  </div>
  <div class="col-xs-5 col-xs-offset-2 text-right">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>To : <?php echo $readrow['fld_cust_name']?></h4>
      </div>
      <div class="panel-body">
        <p>
          <?php echo $readrow['fld_cust_address'] ?> <br>
          <?php echo $readrow['fld_cust_phoneno'] ?> <br>
        </p>
      </div>
    </div>
  </div>
</div>

<table class="table table-bordered">
  <tr>
    <th>No</th>
    <th>Product</th>
    <th class="text-right">Quantity</th>
    <th class="text-right">Price(RM)/Unit</th>
    <th class="text-right">Total(RM)</th>
  </tr>
  <?php
  $grandtotal = 0;
  $counter = 1;
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM tbl_orders_details_a181765, tbl_products_a181765_pt2 where tbl_orders_details_a181765.fld_product_id = tbl_products_a181765_pt2.fld_product_id AND fld_order_num = :oid");
    $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
    $oid = $_GET['oid'];
    $stmt->execute();
    $result = $stmt->fetchAll();
  }
  catch(PDOException $e){
    echo "Error: " . $e->getMessage();
  }
  foreach($result as $detailrow) {
  ?>
  <tr>
    <td><?php echo $counter; ?></td>
    <td><?php echo $detailrow['fld_product_name']; ?></td>
    <td class="text-right"><?php echo $detailrow['fld_order_detail_quantity']; ?></td>
    <td class="text-right"><?php echo $detailrow['fld_price']; ?></td>
    <td class="text-right"><?php echo $detailrow['fld_price']*$detailrow['fld_order_detail_quantity']; ?></td>
  </tr>
  <?php
  $grandtotal = $grandtotal + $detailrow['fld_price']*$detailrow['fld_order_detail_quantity'];
  $counter++;
  } // while
  $conn = null;
  ?>
  <tr>
    <td colspan="4" class="text-right"><strong>Grand Total</strong></td>
    <td class="text-right">RM <?php echo $grandtotal ?></td>
  </tr>
</table>

<div class="row">
  <div class="col-xs-5">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>Bank Details</h4>
      </div>
      <div class="panel-body">
        <p>Account Holder : <?php echo $readrow['fld_cust_name']?></p>
        <p>Bank Name : Bank-Rap Malaysia</p>
        <p>Account Number : 123456789012</p>
        <br>
        <p><strong>Purchase succesful.</strong></p>
      </div>
    </div>
    </div>
  <div class="col-xs-7">
    <div class="span7">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Contact Details</h4>
        </div>
        <div class="panel-body">
          <p> Staff: <?php echo $readrow['fld_staff_name']?> </p>
          <p> Contact No: <?php echo $readrow['fld_phone_no'] ?> </p>
          <p><br></p>
          <p><br></p>
          <p>Computer-generated invoice. No signature is required.</p>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>