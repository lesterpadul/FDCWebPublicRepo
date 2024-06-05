<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My First Website</title>
        <link rel="shortcut icon" href="https://i.ibb.co/GHctgsk/favicon.webp" type="image/x-icon">
        <link rel="stylesheet" href="/cakephp/app/webroot/css/style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    </head>
    <body>

        <header>
            <div class="wrapper">
                <h2> Website ni <span>Jonathan</span></h2>
            </div>
        </header>

        <nav id="navigation">
            <div class="wrapper">
                <ul>
                    <li><a href="/cakephp/home">Home</a></li>
                    <li><a href="/cakephp/about">About</a></li>
                    <li><a href="/cakephp/services">Services</a></li>
                    <li><a href="/cakephp/contact">Contact</a></li>
                </ul>
            </div>
        </nav>

        
            <?php echo $this->Flash->render(); ?>


			<?php echo $this->Flash->render(); ?>

			<?php echo $this->fetch('content'); ?>
			

</div>
		<footer id="main_footer" class="t_center">Copyright &copy; 2024 My First Website</footer>

		<div class="social_media">
			<a href="https://www.facebook.com/Jooooooooooooooooo0/" target="_blank">
				<figure>
					<img src="https://i.ibb.co/Fq7H9MG/fb-logo.webp" alt="">
				</figure>
			</a>
			<a href="">
				<figure>
					<img src="https://i.ibb.co/dDsT7F7/insta.png" alt="">
				</figure>
			</a>
			<a href="https://www.linkedin.com/in/joandrie/" target="_blank">
				<figure>
					<img src="https://i.ibb.co/pLc4sXN/link-in.png" alt="">
				</figure>
			</a>
		</div>

		<script src="cakephp/app/webroot/js/jquery-1.8.2.min.js"></script>    
		<script src="cakephp/app/webroot/js/script.js"></script>
	</body>
</html>