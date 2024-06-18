<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home</title>
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            margin: 0; /* Add margin 0 to the body to remove default margin */
        }

        .user-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            color: #333;
        }

        nav {
            margin-bottom: 20px;
            background-color: #007bff; /* Add background color to the nav bar */
            border-radius: 5px; /* Add border-radius to the nav bar */
        }

        ul.navbar {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        li.nav-item {
            float: left;
        }

        li.nav-item a {
            display: block;
            color: #fff;
            text-align: center;
            padding: 10px 20px;
            text-decoration: none;
        }

        li.nav-item a:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <nav>
        <ul class="navbar">
            <li class="nav-item"><?= $this->Html->link('Edit', ['action'=>'edit', $user['id']]) ?></li>
            <li class="nav-item"><?= $this->Html->link('View profile', ['action'=>'profile', $user['id']]) ?></li>
            <li class="nav-item"><?= $this->Html->link('New Message', ['controller'=>'Message', 'action'=>'message']) ?></li>
        </ul>
    </nav>

    <?= $this->Form->create($user) ?>
    <?php if (!empty($user->picture)): ?>
        <?= $this->Html->image($user->picture, ['alt' => 'User Picture', 'class' => 'user-image']) ?>
    <?php endif; ?>
    <?= $this->Form->end() ?>

    <p>Welcome, <?= h($user['name']); ?>!</p>
    <p>This is your personalized home page. You can customize it further by adding widgets, changing the layout, and more.</p>
    <p>Explore the navigation bar above to access different features like editing your profile, viewing your messages, and more.</p>
    <p>Feel free to reach out if you need any assistance or have questions!</p>

    <?= $this->Form->create('Users', ['url' => ['action' => 'logout'], 'type' => 'post']) ?>
    <?= $this->Form->submit('Logout', ['class' => 'btn btn-danger']) ?>
    <?= $this->Form->end() ?>
</body>

</html>
