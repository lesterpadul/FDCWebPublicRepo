<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .user-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 10px;
            object-fit: cover;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        /* Form styles */
        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        input[type="password"] {
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

        /* Responsive styles */
        @media (max-width: 480px) {
            .container {
                width: 90%;
            }
        }

        /* Additional styles */
        .user-picture {
            max-width: 150px;
            max-height: 150px;
            border-radius: 50%;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<?php if (!empty($this->request->data['Users']['picture'])): ?>
    <img src="<?php echo $this->Html->url('/' . $this->request->data['Users']['picture']); ?>" alt="User Picture" class="user-picture">
<?php endif; ?>
<?php
echo $this->Form->create('Users', ['type' => 'file']);

echo $this->Form->input('picture', ['type' => 'file', 'label' => 'Upload Picture']);
echo $this->Form->input('name', ['label' => 'Name']);
echo $this->Form->input('birthdate', ['label' => 'Birthday', 'type' => 'text', 'id' => 'birthday']);
echo $this->Form->input('gender', [
    'type' => 'radio',
    'options' => [
        'male' => 'Male',
        'female' => 'Female',
    ],
    'label' => 'Gender'
]);
echo $this->Form->input('hobby', ['label' => 'Hobby']);

echo $this->Form->submit('Update', ['class' => 'btn btn-primary']);

echo $this->Form->end();
?>

<script>
    $(document).ready(function() {
        $('#birthday').datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            yearRange: '1900:2100'
        });
    });
</script>

</body>
</html>
