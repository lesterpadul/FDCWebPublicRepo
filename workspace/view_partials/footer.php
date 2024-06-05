<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>My Website</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style>
		body {
			display: flex;
			flex-direction: column;
			min-height: 100vh;
		}
		footer {
			background-color: #343a40;
			color: white;
			padding: 20px 0;
			margin-top: auto;
		}
		footer .container {
			display: flex;
			flex-wrap: wrap;
			justify-content: space-between;
		}
		footer .list-inline {
			margin: 0;
			padding: 0;
		}
		footer .list-inline-item {
			margin-right: 10px;
		}
		footer .list-inline-item a {
			color: white;
			text-decoration: none;
			transition: color 0.3s ease;
		}
		footer .list-inline-item a:hover {
			color: #ddd;
		}
		footer p {
			margin: 0;
		}
	</style>
</head>
<body>

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-6 d-flex align-items-center">
					<ul class="list-inline mb-0">
						<li class="list-inline-item"><a href="#">Facebook</a></li>
						<li class="list-inline-item"><a href="#">Twitter</a></li>
						<li class="list-inline-item"><a href="#">Instagram</a></li>
					</ul>
				</div>
				<div class="col-md-6 d-flex align-items-center justify-content-md-end">
					<p>&copy; 2024 My Website. All rights reserved.</p>
				</div>
			</div>
		</div>
	</footer>
	
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
