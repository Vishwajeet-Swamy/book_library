<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Simple Sidebar - Start Bootstrap Template</title>
		<!-- Bootstrap core CSS -->
		<link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<!-- Custom styles for this template -->
		<link href="<?php echo base_url(); ?>assets/css/simple-sidebar.css" rel="stylesheet">
		<!--jquery-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"> 
    </script> 
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
				<h1 class="mt-4">Add Book</h1>
				<!--flex start-->
                    <div class="d-flex align-content-around flex-wrap">
                        <div class="p-2">
                        <div class="card">
							<img class="card-img-top" id="bookCover" src="<?php echo $data['book_details'][0]->image_url;?>" alt="Card image cap">
							</div>
                        </div>
                        <div class="p-2">
						<form>
							<div class="form-group">
								<label for="title">Title</label>
								<input type="text" class="form-control" id="title" placeholder="Title input" value="<?php echo $data['book_details'][0]->title;?>">
							</div>
							<div class="form-group">
								<label for="author">Author</label>
								<input type="text" class="form-control" id="author" placeholder="Author input" value="<?php echo $data['book_details'][0]->author;?>">
							</div>
							<div class="form-group">
								<label for="category">Category</label>
								<input type="text" class="form-control" id="category" placeholder="Category input" value="<?php echo $data['book_details'][0]->category;?>">
							</div>
							<div class="form-group">
								<label for="imageUrl">Image Url</label>
								<input type="text" class="form-control" id="imageUrl" placeholder="Image input" value="<?php echo $data['book_details'][0]->image_url;?>">
							</div>
							<div class="form-group">
								<label for="count">Count</label>
								<input type="text" class="form-control" id="count" placeholder="Count input" value="<?php echo $data['book_details'][0]->count;?>">
							</div>
							<div class="form-group">
								<label for="price">Price</label>
								<input type="text" class="form-control" id="price" placeholder="Price input" value="<?php echo $data['book_details'][0]->price;?>">
							</div>
							<div class="form-group">
								<label for="description">Description</label>
								<textarea class="form-control" id="description" rows="3" ><?php echo htmlspecialchars($data['book_details'][0]->description); ?></textarea>
							</div>
							<!-- <button type="button" class="btn btn-outline-dark">Submit</button> -->
							<div class="form-group">
								<input type="submit" class="btn btn-outline-dark" name="submit" value="Save" />
							</div>
						</form>
                        </div>
					</div>
				<!--flex end-->
				</div>
			</div>
			<!-- /#page-content-wrapper -->
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

			$("#imageUrl").change(function(){
				$("#bookCover").attr("src",$("#imageUrl").val());
			});
		
			$(document).ready(function () {

			// process the form
				$('form').submit(function (event) {

					var formData = {
						'id':'<?php echo $data['book_details'][0]->id?>',
						'title': $('#title').val(),
						'author': $('#author').val(),
						'category': $('#category').val(),
						'image_url': $('#imageUrl').val(),
						'count': $('#count').val(),
						'price': $('#price').val(),
						'description': $('#description').val()
					};
					if(formData.title == ""){
						alert("title is required");
						return false;
					}
					if(formData.author == ""){
						alert("author is required");
						return false;
					}
					if(formData.category == ""){
						alert("category is required");
						return false;
					}
					if(formData.count == "" || isNaN(formData.count)){
						alert("count is required and must be a number");
						return false;
					}
					if(formData.price == "" || isNaN(formData.price)){
						alert("price is required and must be a number");
						return false;
					}
					// process the form
					$.ajax({
						type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
						url: '<?php echo site_url('dashboard/update_book_details') ?>', // the url where we want to POST
						data: formData, // our data object
						dataType: 'json', // what type of data do we expect back from the server
						encode: true,
						success: function showModal() {
							
							
						}
					})
						// using the done promise callback
						.done(function (data) {
							// log data to the console so we can see
							console.log(data);
							if(data.status == 200){
								$('#modal-msg').append('<p>'+data.message+'</p>');
								$('#modal-action').append('<a href="<?php echo base_url() ?>" class="btn btn-primary" role="button">OK</a>');
								$('#myModal').modal('show');
							}else{
								$('#modal-msg').append('<p>'+data.message+'</p>');
								$("#modal-action").append('<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>');
								$('#myModal').modal('show');
							}
						})

					// stop the form from submitting the normal way and refreshing the page
					event.preventDefault();
				});

			});
		</script>
		
	</body>	
</html>