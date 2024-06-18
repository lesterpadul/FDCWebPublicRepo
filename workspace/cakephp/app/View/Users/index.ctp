<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding-top: 50px; /* Adjust as needed */
        }

        p {
            font-size: 20px;
            color: #333;
            margin-bottom: 20px;
        }

        /* Button styles */
        a.button {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border: 1px solid #007bff;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        a.button:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        /* Additional styles for content */
        .content {
            max-width: 800px;
            margin: 0 auto;
        }

        .highlight {
            color: #ff5733;
            font-weight: bold;
        }

        .quote {
            font-style: italic;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="content">
        <p>Welcome to CakePHP's Home Page!</p>
        <p class="quote">"CakePHP is a delightfully tasty framework for PHP development."</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut maximus purus. Nulla facilisi. In hac habitasse platea dictumst. Nam quis lobortis ante. Duis sit amet arcu eu odio aliquam suscipit. Cras non venenatis sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In rhoncus ex eget lorem pretium, et lacinia neque ullamcorper. Phasellus vitae sapien eu mi fermentum vehicula.</p>
        <p class="highlight">Don't wait, get started with CakePHP today!</p>
        <a href="/cakephp/register" class="button">Register Now</a>
        <a href="/cakephp/login" class="button">Login</a>
    </div>
</body>

</html>
