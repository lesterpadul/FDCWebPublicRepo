<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="?page=admin_dashboard">Admin Side</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link" href="?page=admin_dashboard">Exams</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="?page=view_users">Users</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="?page=contact"></a>
				</li>
				<li class="nav-item">
					<?php if (isset($_SESSION['is_logged_in'])) { ?>
					<a class="nav-link" href="?page=logout">Logout</a>
					<?php } ?>
				</li>
			</ul>
		</div>
	</nav>