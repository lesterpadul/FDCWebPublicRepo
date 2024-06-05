<?php


$result = $db->sql->query("
    select polls.id, question, option_1, option_2, users.username 
    from polls 
    join users ON polls.user_id = users.id 
    where polls.status = 1
");

if($result) {
    $polls = $result->fetch_all(MYSQLI_ASSOC);
}

if (isset($_POST["option"])) {
    $option = $db->sql->real_escape_string($_POST["option"]);
    $poll_id = intval($_POST["poll_id"]);

    if (!$option) {
        echo "You have a missing field";
        die();
    }
  
    $did_vote = $db->sql->query("
        insert into 
        votes
        (poll_id, user_id, selected_option, voted_at)
        values 
        ('{$poll_id}', {$_SESSION['user_id']}, '{$option}', now())");

    if ($did_vote) {
        echo "<script>
            window.location.href = '?page=polls';
        </script>";
        die(); 
    }
    
}

?>

<div class="w-full">
    <h1 class="text-center text-5xl my-10">Polls</h1>

    <div class="flex justify-center">
        <a href="?page=create" class=" shadow-lg bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-2 px-4 rounded">Create a poll</a>
    </div>
</div>




<div class='flex flex-wrap justify-center items-center gap-16 mx-5 my-6'>
    
<?php foreach($polls as $poll): ?>
  
    <?php
    $existing_vote_check = $db->sql->query("
        select id 
        from votes 
        where poll_id = '{$poll['id']}' 
          and user_id = {$_SESSION['user_id']}
    ");
    $has_voted = $existing_vote_check->num_rows > 0;

    $votes_data = $db->sql->query("
        SELECT 
            SUM(CASE WHEN selected_option = 1 THEN 1 ELSE 0 END) as option1_votes, 
            SUM(CASE WHEN selected_option = 2 THEN 1 ELSE 0 END) as option2_votes 
        FROM votes 
        WHERE poll_id = '{$poll['id']}'
    ");
    $votes = $votes_data->fetch_all(MYSQLI_ASSOC);
    // echo "<pre>";
    // var_dump($votes);
    // // die();
    
    ?>



    <?php if (!$has_voted): ?>
        
        <form action="" method="POST" class="w-72">
            <div class='bg-white rounded-md pb-2 shadow-lg'>
                <p class='bg-indigo-600 px-4 py-3 text-white font-bold rounded-t-md'> <?php echo $poll["question"] ?> </p>
                
                <div class='flex flex-col w-full gap-3 pt-3 pb-2 px-2 relative'>
                    <div class='relative w-full h-8'>
                        <input required type='radio' id='option1_<?php echo $poll["id"] ?>' name='option' value=1 class='border-1 border-indigo-700 appearance-none rounded-lg cursor-pointer h-full w-full checked:bg-indigo-600 transition-all duration-200 hover:bg-indigo-200 peer '>
                        <label for='option1_<?php echo $poll["id"] ?>' class='absolute top-[50%] left-3 text-gray-600 -translate-y-[50%] peer-checked:text-gray-100 transition-all duration-200 select-none'><?php echo $poll["option_1"] ?></label>
                    </div>
                    <div class='relative w-full h-8'>
                        <input required type='radio' id='option2_<?php echo $poll["id"] ?>' name='option' value=2 class='border-1 border-indigo-700 appearance-none rounded-lg cursor-pointer h-full w-full checked:bg-indigo-600 transition-all duration-200 hover:bg-indigo-200 peer'>
                        <label for='option2_<?php echo $poll["id"] ?>' class='absolute top-[50%] left-3 text-gray-600 -translate-y-[50%] peer-checked:text-gray-100 transition-all duration-200 select-none'><?php echo $poll["option_2"] ?></label>
                    </div>
                </div>
                <div class='w-full flex flex-row justify-end px-2 pt-1'>
                    <input type="hidden" name="poll_id" value="<?php echo $poll["id"]; ?>">
                    <button type="submit" class='text-gray-900 bg-white-600 border-2 border-indigo-700 w-full rounded-md py-2 font-bold hover:bg-indigo-700 hover:text-white transition-all duration-300'>Vote</button>
                </div>
                <p class="text-slate-600 text-sm text-center my-auto p-2">Created by <?php echo $poll["username"] ?></p>
            </div>
        </form>
    <?php else: ?>
        <div class="border w-90 shadow-lg">
            <canvas class="h-100" style="height: 12rem" id="chart_<?php echo $poll["id"]; ?>"></canvas>
                <p class="text-slate-600 text-sm text-center my-auto p-2">Created by <?php echo $poll["username"] ?></p>
        </div>
        <div class="">
            <? include("./poll_bar_chart.php"); ?>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
</div>

