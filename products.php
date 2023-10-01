<?php
  include_once 'products_crud.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Products | Cookbook Ordering System</title>

	<!-- Datatable plugin CSS file -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

	<!-- ExportTable plugin CSS file -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap.min.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
 
    <style>
    	.gap {
    		margin-left: 70%;
    	}
    	.page-header {
    		color: whitesmoke;
    	}
    	.dataTables_wrapper.no-footer {
    		background-color: whitesmoke;
    		padding: 10px;
    	}
    	label {
    		color: black;
    	}
    	div #table-content.row {
    		background-color: whitesmoke;
    		margin: 30px;
    		border-radius: 30px;
    		padding-bottom: auto;
    	}
    	h2 {
    		color: black;
    	}
    	thead {
    		background-color: #A7727D;
    		text-align: center;
    	}
    	.col-sm-3.control-label {
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
				<h2 style="color: whitesmoke; text-align: center;">Create New Product</h2>
			</div>
			<form action="products.php" method="post" class="form-horizontal">

				<!-- Book ID -->
				<div class="form-group">
					<label for="productid" class="col-sm-3 control-label">ID</label>
					<div class="col-sm-9">
						<input name="pid" type="text" class="form-control" id="productid" placeholder="Book ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_id']; ?>" pattern="CB[0-9]+" required>
					</div>
				</div>

				<!-- Book Title -->
				<div class="form-group">
					<label for="productname" class="col-sm-3 control-label">Book Title</label>
					<div class="col-sm-9">
						<input name="name" type="text" class="form-control" id="productname" placeholder="Book Title" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_name']; ?>" required>
					</div>
				</div>

				<!-- Price -->
				<div class="form-group">
					<label for="productprice" class="col-sm-3 control-label">Price</label>
					<div class="col-sm-9">
						<input name="price" type="number" class="form-control" id="productprice" placeholder="Price" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_price']; ?>" min="0.0" step="0.01" required>
					</div>
				</div>

				<!-- Author -->
				<div class="form-group">
					<label for="productauthor" class="col-sm-3 control-label">Author</label>
					<div class="col-sm-9">
						<input name="author" type="text" class="form-control" id="productauthor" placeholder="Author" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_author']; ?>" required>
					</div>
				</div>

				<!-- Publisher -->
				<div class="form-group">
					<label for="productpublisher" class="col-sm-3 control-label">Publisher</label>
					<div class="col-sm-9">
						<input name="publisher" type="text" class="form-control" id="productpublisher" placeholder="Publisher" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_publisher']; ?>" required>
					</div>
				</div>

				<!-- Pages Number -->
				<div class="form-group">
					<label for="productpages" class="col-sm-3 control-label">No. Pages</label>
					<div class="col-sm-9">
						<input name="pages" type="number" class="form-control" id="productpages" placeholder="Pages Number" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_num_pages']; ?>" min="0.0" step="0.01" required>
					</div>
				</div>

				<!-- ISBN -->
				<div class="form-group">
					<label for="productisbn" class="col-sm-3 control-label">ISBN</label>
					<div class="col-sm-9">
						<input name="isbn" type="text" class="form-control" id="productisbn" placeholder="ISBN" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_isbn']; ?>" required>
					</div>
				</div>
				
				<!-- Button -->
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-9">
						<?php if (isset($_GET['edit'])) { ?>
							<input type="hidden" name="oldpid" value="<?php echo $editrow['fld_product_id']; ?>">
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
		<div class="page-header" style="justify-content: space-between; display: flex;">
			<h2>Cookbook List</h2>
		</div>
		<table id="ptable" class="table table-striped table-bordered">
			<thead>
			<tr>
				<th>Book ID</th>
				<th>Book Title</th>
				<th>Price</th>
				<th>Author</th>
				<th>Publisher</th>
				<th>Num of Pages</th>
				<th>ISBN</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			// Read
			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$stmt = $conn->prepare("SELECT * FROM tbl_products_a181765_pt2");
				$stmt->execute();
				$result = $stmt->fetchAll();
			}
			catch(PDOException $e){
				echo "Error: " . $e->getMessage();
			}
			foreach($result as $readrow) {
			?>
			<tr>
				<td><?php echo $readrow['fld_product_id']; ?></td>
				<td><?php echo $readrow['fld_product_name']; ?></td>
				<td><?php echo $readrow['fld_price']; ?></td>
				<td><?php echo $readrow['fld_author']; ?></td>
				<td><?php echo $readrow['fld_publisher']; ?></td>
				<td><?php echo $readrow['fld_num_pages']; ?></td>
				<td><?php echo $readrow['fld_isbn']; ?></td>
				
				<td>
					<a href="javascript:void(0);" data-href="products_details.php?pid=<?php echo $readrow['fld_product_id']; ?>" class="btn btn-warning btn-xs openPopup" role="button">Details</a>
					<?php
					if(isset($_SESSION['role']) && $_SESSION['role'] === "Supervisor" || $_SESSION['role'] === "Administrator") {
					?>
					<a href="products.php?edit=<?php echo $readrow['fld_product_id']; ?>" class="btn btn-success btn-xs" role="button">Edit</a>
					<a href="products.php?delete=<?php echo $readrow['fld_product_id']; ?>" onclick="return confirm('Are you sure to delete?');" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
					<?php
					}
					?>
				</td>
			</tr>
			<?php
			}
			$conn = null;
			?>
			</tbody>
		</table>

	</div>
</div>
<div class="modal fade" id="pdmodal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

		</div>
	</div>
</div>

	<!-- jQuery library file -->
	<script src="jquery-3.5.1.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="src/jquery.table2excel.js"></script>

	<!-- Datatable plugin JS library file -->
	<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap.min.js"></script>
	
	<!-- Javascript for File Export -->
	<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>

</body>
</html>
<script>
$(document).ready(function(){
    $('.openPopup').on('click',function(){
    	var dataURL = $(this).attr('data-href');
        $('.modal-content').load(dataURL,function(){
            $('#pdmodal').modal({show:true});
        });
    });
    $('#pdmodal').on('hidden.bs.modal', function() {
    	location.reload();
    });
    $('#ptable').DataTable({
    	"lengthMenu": [[5, 10, 20, 30, -1], [5, 10, 20, 30, 'All']],
    	"columnDefs": [{ "width": "120px", "targets": 7 }],
    	dom : '<"float-left"l><"float-right gap"B><"float-right"f>rtip',
    	buttons: [
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i>',
                titleAttr: 'Excel'
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf-o"></i>',
                titleAttr: 'PDF'
            }
        ],
    	pagingType: "full_numbers"
    });
    
});
</script>