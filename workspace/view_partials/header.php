<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>My Website</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style>
		.navbar {
			margin-bottom: 20px;
		}
		.navbar-brand {
			font-weight: bold;
			color: #fff !important;
		}
		.nav-item .nav-link {
			color: #fff !important;
			padding: 10px 15px;
			transition: background-color 0.3s ease;
		}
		.nav-item .nav-link:hover {
			background-color: rgba(255, 255, 255, 0.1);
			border-radius: 5px;
		}
		.nav-item.active .nav-link {
			background-color: rgba(255, 255, 255, 0.2);
			border-radius: 5px;
		}
		.navbar-toggler {
			border: none;
		}
		.navbar-toggler-icon {
			color: #fff;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="?page=home">My Website</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active">
					<a class="nav-link" href="?page=home">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="?page=about">About</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="?page=contact">Contact</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="?page=register">Register</a>
				</li>
				<?php if (isset($_SESSION['is_logged_in'])) { ?>
				<li class="nav-item">
					<a class="nav-link" href="?page=logout">Logout</a>
				</li>
				<?php } ?>
			</ul>
		</div>
	</nav>

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
