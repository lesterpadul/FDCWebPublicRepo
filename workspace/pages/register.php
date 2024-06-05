<?php

class Register {
    public $first_name;
    public $last_name;
    public $username;
    public $password;
    public $cpassword;

    public function __construct($first_name = "unnamed", $last_name = "unnamed", $username = "unnamed", $password = "none", $cpassword = "none") {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->username = $username;
        $this->password = $password;
        $this->cpassword = $cpassword;
    }

    public function registerMe($db) {
        if (isset($_POST["user_firstname"])) {
            $this->first_name = $db->sql->real_escape_string($_POST["user_firstname"]);
            $this->last_name = $db->sql->real_escape_string($_POST["user_lastname"]);
            $this->username = $db->sql->real_escape_string($_POST["username"]);
            $this->password = $db->sql->real_escape_string($_POST["user_password"]);
            $this->cpassword = $db->sql->real_escape_string($_POST["user_confirm_password"]);
            if (!$this->first_name || !$this->last_name || !$this->username || !$this->password || !$this->cpassword) {
                $this->isRegisterFail();
            }
            if ($this->password != $this->cpassword) {
                $this->isRegisterNotMatch();
            }
            $this->isRegistered($db);
        }
    }

    private function isRegisterFail() {
        throw new Exception("ERROR: There are still fields left unset!");
    }

    private function isRegisterNotMatch() {
        throw new Exception("Error: Passwords do not match");
    }

    public function isRegistered($db) {
        $password = password_hash($this->password, PASSWORD_DEFAULT);
        $did_register = $db->sql->query("INSERT INTO users (status, first_name, last_name, username, password) VALUES (1, '{$this->first_name}', '{$this->last_name}', '{$this->username}', '{$password}')");

        /*if ($did_register) {
            $user_id = $db->sql->insert_id;
            $result = $db->sql->query("SELECT * FROM users WHERE id = $user_id");
            $user = $result->fetch_assoc();

            $_SESSION["is_logged_in"] = true;
            $_SESSION["user_id"] = $user['id'];
            $_SESSION["first_name"] = $user['first_name'];
            $_SESSION["last_name"] = $user['last_name'];
            $_SESSION["username"] = $user['username'];
            $_SESSION["last_login_time"] = time();

            echo "SUCCESS: User has been registered!";
        }*/
        echo "SUCCESS: User has been registered!";
    }
}
try {
    $db = new DB();
    $newRegister = new Register();
    $newRegister->registerMe($db);
} catch (Exception $err) {
    echo $err->getMessage();
}


?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Registration Form</h3>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="name">FirstName</label>
                            <input type="text" name="user_firstname" class="form-control" value="<?php echo @$_POST['user_firstname']; ?>">

                        </div>
                        <div class="form-group">
                            <label for="name">LastName</label>
                            <input type="text" name="user_lastname" class="form-control" value="<?php echo @$_POST['user_lastname']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="user_password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Confirm</label>
                            <input type="password" name="user_confirm_password" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
