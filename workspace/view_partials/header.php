<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<!-- <style>
		/* Ensure the form elements are displayed side by side */
		form.inline-form {
			display: inline-block;
			margin: 0;
		}

		button-group {
			display: flex;
			gap: 10px; /* Add some space between the buttons */
		}

		/* Add any additional styling you need */
		.btn {
			padding: 10px 20px;
			font-size: 14px;
			cursor: pointer;
		}

		.btn-danger {
			background-color: #dc3545;
			color: white;
			border: none;
		}

		.btn-primary {
			background-color: #007bff;
			color: white;
			border: none;
		}

	</style> -->
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="?page=home">My Website</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="?page=home">Home</a>
				</li>
				<li class="nav-item">
					<?php if (!isset($_SESSION['is_logged_in'])) { ?>
						<a class="nav-link" href="?page=register">Add Users</a>
					<?php } ?>
				</li>
				<li class="nav-item">
					<?php if (isset($_SESSION['is_logged_in'])) { ?>
						<a class="nav-link" href="?page=addcategory">Add Category</a>
					<?php } ?>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="?page=homepage">Buyer Home</a>
				</li>
			</ul>
			<ul class="navbar-nav">
				<li class="nav-item">
					<?php if (isset($_SESSION['is_logged_in'])) { ?>
							<a class="nav-link" href="?page=cart">Cart</a>
					<?php } ?>
				</li>
				<li class="nav-item">
					<?php if (isset($_SESSION['is_logged_in'])) { ?>
						<a class="nav-link" href="?page=logout">Logout</a>
					<?php } ?>
				</li>
		</div>
	</nav>
