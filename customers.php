<?php
  include_once 'customers_crud.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Customers | Cookbook Ordering System</title>
	<!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <style type="text/css">
    	div #table-content.row {
    		background-color: whitesmoke;
    		margin: 30px;
    		border-radius: 30px;
    		padding-bottom: auto;
    	}
    	label {
    		color: whitesmoke;
    	}
    </style>
</head>
<body>

	<?php include_once 'nav_bar.php'; ?>
 
<div class="container-fluid">
	<?php
	if(isset($_SESSION['role']) && $_SESSION['role'] === "Supervisor" || $_SESSION['role'] === "Administrator") {
	?>
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
			<div class="page-header">
				<h2 style="color: whitesmoke; text-align: center;">Create New Customer</h2>
			</div>
			<form action="customers.php" method="post" class="form-horizontal">
				
				<!-- Customer ID -->
				<div class="form-group">
					<label for="customerid" class="col-sm-3 control-label">ID</label>
					<div class="col-sm-9">
						<input name="cid" type="text" class="form-control" id="customerid" placeholder="Customer ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_cust_id']; ?>" pattern="C[0-9]+" required>
					</div>
				</div>

				<!-- Customer Name -->
				<div class="form-group">
					<label for="name" class="col-sm-3 control-label">Customer Name</label>
					<div class="col-sm-9">
						<input name="name" type="text" class="form-control" id="name" placeholder="Customer Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_cust_name']; ?>" required>
					</div>
				</div>

				<!-- Customer Address -->
				<div class="form-group">
					<label for="customeraddress" class="col-sm-3 control-label">Address</label>
					<div class="col-sm-9">
						<input type="text" name="address" class="form-control" id="customeraddress" placeholder="Customer Address" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_cust_address']; ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="customerphonenumber" class="col-sm-3 control-label">Phone Number</label>
					<div class="col-sm-9">
						<input name="phone" type="tel" class="form-control" id="customerphonenumber" placeholder="Customer Phone Number" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_cust_phoneno']; ?>" required>
					</div>
				</div>
				
				<!-- Button -->
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-9">
						<?php if (isset($_GET['edit'])) { ?>
							<input type="hidden" name="oldcid" value="<?php echo $editrow['fld_cust_id']; ?>">
							<button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
						<?php } else { ?>
							<button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
						<?php } ?>
						<button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php
		}
	?>
	<div class="row" id="table-content">
		<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1">
			<div class="page-header">
				<h2>Customers List</h2>
			</div>
			<table class="table table-striped table-bordered">
				<tr>
					<th>Customer ID</th>
					<th>Customer Name</th>
					<th>Home Address</th>
					<th>Phone Number</th>
					<?php
					if(isset($_SESSION['role']) && $_SESSION['role'] === "Supervisor" || $_SESSION['role'] === "Administrator") {
						?>
					<th width="10%"></th>
				<?php 
			} 
			?>
				</tr>
				<?php
				// Read
				$per_page = 5;
				if (isset($_GET["page"]))
					$page = $_GET["page"];
				else
					$page = 1;
				$start_from = ($page-1) * $per_page;
				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare("SELECT * FROM tbl_customers_a181765_pt2 LIMIT $start_from, $per_page");
					$stmt->execute();
					$result = $stmt->fetchAll();
				}
				catch(PDOException $e){
					echo "Error: " . $e->getMessage();
				}
				foreach($result as $readrow) {
				?>
				<tr>
					<td><?php echo $readrow['fld_cust_id']; ?></td>
					<td><?php echo $readrow['fld_cust_name']; ?></td>
					<td><?php echo $readrow['fld_cust_address']; ?></td>
					<td><?php echo $readrow['fld_cust_phoneno']; ?></td>
					<td>
						<?php
						if(isset($_SESSION['role']) && $_SESSION['role'] === "Supervisor" || $_SESSION['role'] === "Administrator") {
						?>
						<a href="customers.php?edit=<?php echo $readrow['fld_cust_id']; ?>" class="btn btn-success btn-xs" role="button">Edit</a>
						<a href="customers.php?delete=<?php echo $readrow['fld_cust_id']; ?>" onclick="return confirm('Are you sure to delete?');" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
						<?php
						}
						?>
					</td>
				</tr>
				<?php
				}
				$conn = null;
				?>
			</table>
		</div>
	<!-- <div class="row"> -->
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-1">
      <nav>
          <ul class="pagination">
          <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tbl_customers_a181765_pt2");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $total_records = count($result);
          }
          catch(PDOException $e){
                echo "Error: " . $e->getMessage();
          }
          $total_pages = ceil($total_records / $per_page);
          ?>
          <?php if ($page==1) { ?>
            <li class="disabled"><span aria-hidden="true">«</span></li>
          <?php } else { ?>
            <li><a href="customers.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"customers.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"customers.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="customers.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
<!--   </div>
</div> -->

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>

</body>
</html>