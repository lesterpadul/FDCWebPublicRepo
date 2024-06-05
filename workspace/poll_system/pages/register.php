
<?php

// if has data, likely post request
if (isset($_POST["first_name"])) {
    // Get the values from the form and sanitize them
    $username = $db->sql->real_escape_string($_POST["username"]);
    $first_name = $db->sql->real_escape_string($_POST["first_name"]);
    $last_name = $db->sql->real_escape_string($_POST["last_name"]);
    $password = $db->sql->real_escape_string($_POST["password"]);
    $cpassword = $db->sql->real_escape_string($_POST["confirm_password"]);

    // Check if any of the fields are empty
    if (!$username || !$first_name || !$last_name || !$password || !$cpassword) {
        echo "you have a missing field";
        die();
    }

    // Check if the passwords match
    if ($password != $cpassword) {
        echo "passwords do not match";
        die();
    }

    // Encrypt the password using the default algorithm
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user data into the database
    $data = [
        'username' => $username,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'password' => $password,
        'created_at' => date('Y-m-d H:i:s')
    ];

    $did_register = $db->insertData('users', $data);

    if ($did_register) {
        // Retrieve the newly inserted user data
        $result = $db->sql->query(
            "select * from users where id = {$db->sql->insert_id}"
        );
        $user = $result->fetch_all(MYSQLI_ASSOC);

        // Set session variables for the logged-in user
        $_SESSION["is_logged_in"] = true;
        $_SESSION["user_id"] = $user[0]['id'];
        $_SESSION["username"] = $user[0]['username'];
        $_SESSION["first_name"] = $user[0]['first_name'];
        $_SESSION["last_name"] = $user[0]['last_name'];
        $_SESSION["last_login_time"] = time();

        // Redirect to another page
        echo "<script>
            window.location.href = '?page=home';
        </script>";
        die();
    }

}

?>



<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Register</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6" action="" method="POST">
      <div>
        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
        <div class="mt-2">
          <input id="email" name="username" type="text" value="<?php echo @$_POST['username']; ?>" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>
      <div>

        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">First name</label>
        <div class="mt-2">
          <input id="email" name="first_name" type="text" value="<?php echo @$_POST['first_name']; ?>" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>      

      <div>
        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Last name</label>
        <div class="mt-2">
          <input id="email" name="last_name" type="text" value="<?php echo @$_POST['last_name']; ?>" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
        <div class="mt-2">
          <input id="password" name="password" type="password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>
            <div>
        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Confirm password</label>
        <div class="mt-2">
          <input id="password" name="confirm_password" type="password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <button type="submit" name="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign up</button>
      </div>
    </form>

    <p class="mt-10 text-center text-sm text-gray-500">
      Already have an account?
      <a href="?page=login" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Login</a>
    </p>

  </div>
</div>
