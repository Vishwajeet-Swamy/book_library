<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Online Book Library</title>
		<!-- Bootstrap core CSS -->
		<link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<!-- Custom styles for this template -->
		<link href="<?php echo base_url(); ?>assets/css/simple-sidebar.css" rel="stylesheet">
	</head>
	<body>
		<div class="d-flex" id="wrapper">
			<!-- Sidebar -->
			<div class="bg-light border-right" id="sidebar-wrapper">
				<div class="sidebar-heading">Book Library</div>
				<div class="list-group list-group-flush">
				<a href="<?php echo base_url() ?>" class="list-group-item list-group-item-action bg-light">Dashboard</a>
				<a href="<?php echo site_url('dashboard/add_book') ?>" class="list-group-item list-group-item-action bg-light">Add Books</a>
				<a href="<?php echo site_url('dashboard/book_list') ?>" class="list-group-item list-group-item-action bg-light">Book List</a>
				</div>
			</div>
			<!-- /#sidebar-wrapper -->

			<!-- Page Content -->
			<div id="page-content-wrapper">
				<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
					<button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>&nbsp;&nbsp;
					<a class="navbar-brand"></a>		
				</nav>
				<div class="container-fluid">
					<h1 class="mt-4">Dashboard</h1>
					<!--flex start-->
					<div class="d-flex align-content-around flex-wrap">
					<?php if(isset($data) && $data['row_count'] > 0){ 
						foreach($data['book_details'] as $book_detail){ 
							$site_url = site_url('dashboard/update_delete/');
							$edit_url = $site_url.$book_detail->id.'-edit';
							?>
						<div class="p-2">
							<div class="card" style="width: 18rem;">
							<img class="card-img-top" src="<?php echo $book_detail->image_url;?>" alt="Card image cap">
								<div class="card-body">
									<h5 class="card-title"><?php echo $book_detail->title;?></h5>
									<p class="card-text"><?php echo $book_detail->description;?></p>
									<p class="card-text"><?php echo $book_detail->count;?></p>
									<p class="card-text">&#x20B9;<?php echo $book_detail->price;?></p>
									<a href="<?php echo $edit_url; ?>" class="btn btn-outline-dark" role="button">Edit</a> &nbsp;&nbsp;
									<a href="#" class="btn btn-outline-dark" role="button" data-id="<?php echo $book_detail->id;?>-remove">Remove</a>
								</div>
							</div>
						</div>
						<?php 
						}
					}else{?>
					
						<div class="p-2">
							<h5> No Books to disply. Pleasae Add books.
							</h5>
						</div>
					
					<?php 
						} 
					?>
					</div>
					
					<!--flex end-->
	
				</div>
				<div class="modal" id="myModal" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Book details</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" id="modal-msg">
						
					</div>
					<div class="modal-footer" id="modal-action">
					
					</div>
					</div>
				</div>
			</div>
			</div>
			<!-- /#page-content-wrapper -->

		</div>
		<!-- /#wrapper -->

		<!-- Bootstrap core JavaScript -->
		<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

		<!-- Menu Toggle Script -->
		<script>
		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper").toggleClass("toggled");
		});
		$(document).ready(function(){
			$(".card-body a").on("click", function(){
				var dataId = $(this).attr("data-id");
				$.ajax({
						type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
						url: '<?php echo site_url('dashboard/update_delete') ?>', // the url where we want to POST
						data: {"update_delete":dataId}, // our data object
						dataType: 'json', // what type of data do we expect back from the server
						encode: true,
						success: function showModal() {
							
							
						}
					})
						// using the done promise callback
						.done(function (data) {
							// log data to the console so we can see
							console.log(data);
							if(data.status == 201){
								$('#modal-msg').append('<p>'+data.message+'</p>');
								$('#modal-action').append('<a href="<?php echo base_url() ?>" class="btn btn-primary" role="button">OK</a>');
								$('#myModal').modal('show');
							}else{
								$('#modal-msg').append('<p>'+data.message+'</p>');
								$("#modal-action").append('<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>');
								$('#myModal').modal('show');
							}
						})
			});
		});
		</script>

	</body>	
</html>