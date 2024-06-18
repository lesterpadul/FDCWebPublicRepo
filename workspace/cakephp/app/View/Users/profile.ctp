<?php
$birthYear = date('Y', strtotime($user['birthdate']));
$createdYear = date('Y', strtotime($user['created']));
$age = $createdYear - $birthYear;
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .user-info {
            margin-bottom: 15px;
        }

        .user-info p {
            margin: 5px 0;
        }

        .user-picture {
            width: 150px; 
            height: 150px; 
            object-fit: cover; 
            border-radius: 50%;
            margin-bottom: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <img src="<?php echo $this->Html->url('/' . $user['picture']); ?>" alt="User Picture" class="user-picture">

    <h1>User Profile</h1>

    <div class="user-info">
        <p><strong>Hello,</strong> <?php echo $user['name']; ?></p> 
        <p><strong>Age:</strong> <?php echo $age; ?></p>
        <p><strong>Birthday:</strong> <?php echo $user['birthdate']; ?></p>
        <p><strong>Joined:</strong> <?php echo $user['created']; ?></p>
        <p><strong>Last Login:</strong> <?= date('Y-m-d H:i:s') ?></p>
        <p><strong>Gender:</strong> <?php echo $user['gender']; ?></p>
        <p><strong>Hobby:</strong> <?php echo $user['hobby']; ?></p>
    </div>
</div>

</body>
</html>
