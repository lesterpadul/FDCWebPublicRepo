<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?php echo $title_for_layout; ?></title>
    <?php
    echo $this->Html->meta('icon');

    // Load Bootstrap CSS from CDN
    echo $this->Html->css('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
    echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');

    // Load custom CSS if any
    echo $this->Html->css('styles');
    ?>
</head>

<body>
    <div class="container">
        <?php echo $this->Flash->render(); ?>
        <?php echo $this->fetch('content'); ?>
    </div>

    <?php
    // Load jQuery, Popper.js, and Bootstrap JS from CDN
    echo $this->Html->script('https://code.jquery.com/jquery-3.5.1.slim.min.js');
    echo $this->Html->script('https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js');
    echo $this->Html->script('https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js');
    ?>
</body>
</html>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
		integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
		crossorigin="anonymous"></script>