<?php

// if has data, likely post request
if (isset($_POST["question"])) {
    // Get the values from the form and sanitize them
    $question = $db->sql->real_escape_string($_POST["question"]);
    $option1 = $db->sql->real_escape_string($_POST["option1"]);
    $option2 = $db->sql->real_escape_string($_POST["option2"]);


    // Check if any of the fields are empty
    if (!$question || !$option1 || !$option2) {
        echo "you have a missing field";
        die();
    }

    $data = [
        'user_id' => $_SESSION['user_id'],
        'question' => $question,
        'option_1' => $option1,
        'option_2' => $option2,
        'created_at' => date('Y-m-d H:i:s')
      ];

      $did_create_poll = $db->insertData('polls', $data);

    if ($did_create_poll) {

        // Retrieve the newly inserted poll data
      $result = $db->sql->query(
            "select * from polls where id = {$db->sql->insert_id}"
        );

      $poll = $result->fetch_all(MYSQLI_ASSOC);
        // var_dump($result)

        // setting the session to store in votes table
      $_SESSION["poll_id"] = $poll[0]['id'];
        

        // Redirect to the home page
      echo "<script>
              window.location.href = '?page=polls';
            </script>";
      die(); 
    }
}

?>

<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Create a poll</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6" action="" method="POST">
      <div>
        <label for="question" class="block text-sm font-medium leading-6 text-gray-900">Question</label>
        <div class="mt-2">
          <input id="question" name="question" type="text" autocomplete="question" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>
      <div>
        <label for="option1" class="block text-sm font-medium leading-6 text-gray-900">Option 1</label>
        <div class="mt-2">
          <input id="option1" name="option1" type="text" autocomplete="option1" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>
      <div>
        <label for="option2" class="block text-sm font-medium leading-6 text-gray-900">Option 2</label>
        <div class="mt-2">
          <input id="option2" name="option2" type="text" autocomplete="option2" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>


      <div>
        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create poll</button>
      </div>
    </form>
    
  </div>