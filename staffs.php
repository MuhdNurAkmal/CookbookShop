<?php
  include_once 'staffs_crud.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Staffs | Cookbook Ordering System</title>
	<!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
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

	<?php
		include_once 'nav_bar.php';
		if(isset($_SESSION['role']) && $_SESSION['role'] === "Supervisor" || $_SESSION['role'] === "Administrator") {
	?>

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
			<div class="page-header">
				<h2 style="color: whitesmoke; text-align: center;">Create New Staff</h2>
			</div>
			<form action="staffs.php" method="post" class="form-horizontal">

				<!-- Staff ID -->
				<div class="form-group">
					<label for="staffid" class="col-sm-3 control-label">ID</label>
					<div class="col-sm-9">
						<input name="sid" type="text" class="form-control" id="staffid" placeholder="Staff ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_id']; ?>" pattern="S[0-9]+" required>
					</div>
				</div>

				<!-- Staff Name -->
				<div class="form-group">
					<label for="stafffirstname" class="col-sm-3 control-label">Staff Name</label>
					<div class="col-sm-9">
						<input name="name" type="text" class="form-control" id="stafffirstname" placeholder="Staff Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_name']; ?>" required>
					</div>
				</div>

				<!-- Phone Number -->
				<div class="form-group">
					<label for="staffphone" class="col-sm-3 control-label">Phone Number</label>
					<div class="col-sm-9">
						<input name="phone" type="tel" class="form-control" id="staffphone" placeholder="Staff Phone Number" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_phone_no']; ?>" required>
					</div>
				</div>

				<!-- Username -->
				<div class="form-group">
					<label for="staffusername" class="col-sm-3 control-label">Username</label>
					<div class="col-sm-9">
						<input name="staffusername" type="text" class="form-control" id="staffusername" placeholder="Username" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_username']; ?>" required>
					</div>
				</div>

				<!-- Password -->
				<div class="form-group">
					<label for="staffpassword" class="col-sm-3 control-label">Password</label>
					<div class="col-sm-9">
						<input name="staffpassword" type="password" class="form-control" id="staffpassword" placeholder="Staff Password" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_password']; ?>" required>
					</div>
				</div>

				<!-- Role -->
				<div class="form-group">
					<label for="staffrole" class="col-sm-3 control-label">User Level</label>
					<div class="col-sm-9">
						<select name="role" class="form-control" id="staffrole" required>
							<option value="">Please select</option>
							<option value="Normal Staff" <?php if(isset($_GET['edit'])) if($editrow['fld_role']=="Normal Staff") echo "selected"; ?>>Normal Staff</option>
							<option value="Supervisor" <?php if(isset($_GET['edit'])) if($editrow['fld_role']=="Supervisor") echo "selected"; ?>>Supervisor</option>
							<option value="Administrator" <?php if(isset($_GET['edit'])) if($editrow['fld_role']=="Administrator") echo "selected"; ?>>Administrator</option>
						</select>
					</div>
				</div>


				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-9">
						<?php if (isset($_GET['edit'])) { ?>
							
							<input type="hidden" name="oldsid" value="<?php echo $editrow['fld_staff_id']; ?>">
							<button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
						
						<?php }
						else { 
							if(isset($_SESSION['role']) && $_SESSION['role'] === "Administrator") { ?>
								<button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
							<?php } 
						}?>
						<button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="row" id="table-content">
		<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
			<div class="page-header">
				<h2>Staffs List</h2>
			</div>
			<table class="table table-striped table-bordered">
				<tr>
					<th>Staff ID</th>
					<th>Staff Name</th>
					<th>Phone Number</th>
					<th>Username</th>
					<th>Password</th>
					<th>Role</th>
					<th></th>
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
					$stmt = $conn->prepare("SELECT * FROM tbl_staffs_a181765_pt2 LIMIT $start_from, $per_page");
					$stmt->execute();
					$result = $stmt->fetchAll();
				}
				catch(PDOException $e){
					echo "Error: " . $e->getMessage();
				}
				foreach($result as $readrow) {
				?>
				<tr>
					<td><?php echo $readrow['fld_staff_id']; ?></td>
					<td><?php echo $readrow['fld_staff_name']; ?></td>
					<td><?php echo $readrow['fld_phone_no']; ?></td>
					<td><?php echo $readrow['fld_username']; ?></td>
					<td><?php echo $readrow['fld_password']; ?></td>
					<td><?php echo $readrow['fld_role']; ?></td>
					<td>
						<a href="staffs.php?edit=<?php echo $readrow['fld_staff_id']; ?>" class="btn btn-success btn-xs" role="button">Edit</a>
						<a href="staffs.php?delete=<?php echo $readrow['fld_staff_id']; ?>" onclick="return confirm('Are you sure to delete?');" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
					</td>
				</tr>
				<?php
				}
				$conn = null;
				?>
			</table>
		</div>

    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <nav>
          <ul class="pagination">
          <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a181765_pt2");
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
            <li><a href="staffs.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"staffs.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"staffs.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="staffs.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
  </div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>

</body>
</html>
<?php
	}
	else {
		echo '<script>alert("Unauthorized user. You are not allowed to access this page.");history.go(-1);</script>';
	}
?>