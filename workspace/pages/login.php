<?php
   class Login{
       public function __construct($db){

        if (isset($_POST["username"])) {
        $user = $_POST["username"];

        $result = $db->sql->query("
            select * from users 
            where 
                username = '$user'
        ");

        if ($result->num_rows > 0) {
            $user = $result->fetch_all(MYSQLI_ASSOC);
            $password = password_verify(trim($_POST["password"]), $user[0]["password"]);
            if (!$password) {
                throw new Exception("Error: Password is wrong");
                die();
                
            }
            
            $_SESSION["is_logged_in"] = true;
            $_SESSION["user_id"] = $user[0]['id'];
            $_SESSION["first_name"] = $user[0]['first_name'];
            $_SESSION["last_name"] = $user[0]['last_name'];
            $_SESSION["last_login_time"] = time();
           
            echo "<script>
                window.location.href = '?page=home';
            </script>";
            die();

        } else {
            throw new Exception("Error! ID: {$_POST["username"]} does not exist!");
        }

        } 
    }
}
try{
    $db = new DB();
    $newLogin = new Login($db);
}catch(Exception $err){
    echo $err->getMessage();
}

?>
<div class="container">
    <h2>Login Form</h2>
    <form action="?page=login" method="POST">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" placeholder="Enter Username">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" placeholder="Enter password">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>