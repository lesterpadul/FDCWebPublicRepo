<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* General styles */
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

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            padding: 10px;
            border: none;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>New Message</h1>
    <form action="<?php echo $this->Html->url(['controller' => 'Message', 'action' => 'message']);?>" method="post">
        <label for="recipient">Recipient</label>
        <select id="recipient" name="recipient"></select><br>
        
        <label for="message">Message</label>
        <textarea name="message" rows="8" cols="35"></textarea><br>
        
        <input type="submit" name="submit" value="Send Message">
    </form>
    <?php echo $this->Html->link(__('View Combined Messages'), ['controller' => 'Message', 'action' => 'combinedMessages', $user['id']]);?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#recipient').select2({
                placeholder: 'Select a recipient',
                ajax: {
                    url: 'getUsers', 
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term 
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.items 
                        };
                    },
                    cache: true
                },
                minimumInputLength: 1,
            });
        });
    </script>
</div>

</body>
</html>
