<?


//current user
$user_result = $db->sql->query(
    "select * from users where id = {$_SESSION['user_id']}"
);
$user = $user_result->fetch_assoc();

//gets all polls created by the current user
$poll_result = $db->sql->query(
    "select * from polls where user_id = {$_SESSION['user_id']} and status = 1"
);
$polls = $poll_result->fetch_all(MYSQLI_ASSOC);


//deletes the selected poll
if (isset($_POST["action_type"]) && $_POST["action_type"] == "delete") {
	$db->sql->query("
		update polls
			set status = 0
			where id = {$_POST['id']};");

    echo "<script>
            window.location.href = '?page=profile';
        </script>";
    die(); 
}
?>


<div class="border rounded my-20 mx-32 p-5 shadow-lg">
  <div class="px-4 sm:px-0">
    <h3 class="text-xl font-semibold my-auto text-gray-900">Personal details</h3>
    <!-- <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Personal details and application.</p> -->
  </div>
  <div class="mt-6 border-t border-gray-100">
    <dl class="divide-y divide-gray-100">
      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
        <dt class="text-sm font-medium leading-6 text-gray-900">Username</dt>
        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"><? echo $user["username"] ?></dd>
      </div>
      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
        <dt class="text-sm font-medium leading-6 text-gray-900">Full name</dt>
        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"><?php echo $user["first_name"] . " " . $user["last_name"] ?></dd>
      </div>
      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
        <dt class="text-sm font-medium leading-6 text-gray-900">Polls</dt>
        <dd class="mt-2 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
          <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200">
            <? foreach($polls as $poll): ?>
            <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
              <div class="flex w-0 flex-1 items-center">
                <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M2 2a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2H4a2 2 0 01-2-2V2zm2-1a1 1 0 00-1 1v14a1 1 0 001 1h14a1 1 0 001-1V2a1 1 0 00-1-1H4z" clip-rule="evenodd" />
                    <path d="M9 13a1 1 0 011-1h4a1 1 0 010 2h-4a1 1 0 01-1-1zm0-4a1 1 0 011-1h6a1 1 0 010 2h-6a1 1 0 01-1-1zm0-4a1 1 0 011-1h8a1 1 0 010 2h-8a1 1 0 01-1-1z" />
                </svg>
                
                <div class="ml-4 flex min-w-0 flex-1 gap-2">
                  <span class="truncate font-medium"><? echo $poll["question"] ?></span>
                  
                </div>
              </div>
              <div class="ml-4 flex-shrink-0 border rounded">
                <form action="?page=profile" method="POST">
                  <input type="hidden" name="action_type" value="delete" />
                  <input type="hidden" name="id" value="<?php echo $poll["id"]; ?>" />
                  <button type="submit" class="shadow-lg bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded">Delete</button>
                </form>
              </div>
            </li>
            <?php endforeach; ?>
          </ul>
        </dd>
      </div>
    </dl>
  </div>
</div>
