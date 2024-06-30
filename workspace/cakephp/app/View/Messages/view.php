<section class="flex h-screen flex-col justify-center items-center w-full">
    <?php echo $this->Flash->render(); ?>
    <div class="flex items-center gap-1 m-1">
        <img class="w-10 h-10 rounded-full" src="<?php echo $this->Html->url("/" . $recipientImage); ?>"
            alt="Sender's Image">
        <p class="font-bold text-lg dark:text-white"><?= $recipientName ?></p>
    </div>

    <div id="messageContainer"
        class="relative w-full max-w-lg overflow-y-scroll bg-white border border-gray-100 rounded-lg dark:bg-gray-800 dark:border-gray-600 h-96 p-5">
        <?php foreach ($messageDetails as $messageDetail): ?>
        <?php if ($messageDetail["messages"]["receiver_id"] == $currentUserID): ?>
        <div id="sender" class="message flex items-start gap-2.5 mb-5">
            <img class="w-8 h-8 rounded-full"
                src="<?php echo $this->Html->url("/" . $messageDetail["sender_users"]["profile_image"]); ?>"
                alt="Sender's Image">
            <div
                class="flex flex-col leading-1.5 p-3 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
                <div class="flex items-center space-x-2 rtl:space-x-reverse">
                    <span class="text-xs font-normal text-gray-500 dark:text-gray-400">
                        <?php echo date("Y/m/d | H:i",strtotime($messageDetail["messages"]["created_at"])); ?>
                    </span>
                </div>

                <p class="text-sm font-normal py-2.5 text-gray-900 dark:text-white">
                    <?php echo $messageDetail["messages"]["message"]; ?></p>
            </div>
        </div>

        <?php elseif ($messageDetail["messages"]["sender_id"] == $currentUserID): ?>
        <div class="message flex justify-end items-center gap-2.5 mb-5">
            <div
                class="flex flex-col leading-1.5 p-3 border-gray-200 bg-blue-600 rounded-s-xl rounded-ee-xl dark:bg-blue-600">
                <div class="flex items-center space-x-2 rtl:space-x-reverse">
                    <span class="text-xs font-normal text-gray-300 dark:text-gray-300">
                        <?php echo date("Y/m/d | H:i", strtotime($messageDetail["messages"]["created_at"])); ?>
                    </span>
                </div>
                <p class="text-sm font-normal py-2.5 text-white dark:text-white"><?php echo $messageDetail[
               "messages"]["message"]; ?></p>
            </div>
            <div class="flex flex-col gap-2">
                <img class="w-8 h-8 rounded-full" src="<?php echo $this->Html->url(
               "/" . $messageDetail["sender_users"]["profile_image"]); ?>" alt="Sender's Image">
                <button id="dropdownMenuIconButton"
                    data-dropdown-toggle="msgOption<?php echo $messageDetail["messages"]["id"]; ?>"
                    data-dropdown-placement="bottom-start"
                    class="inline-flex self-center items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-900 dark:focus:ring-gray-600"
                    type="button">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                        <path
                            d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 0 1 3 0Z" />
                    </svg>
                </button>
            </div>
            <div id="msgOption<?php echo $messageDetail["messages"]["id"]; ?>"
                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-40 dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
                    <li>
                        <p id="deleteButton" data-modal-target="deleteModal<? echo $messageDetail["messages"]["id"] ?> " data-modal-toggle="deleteModal<? echo $messageDetail["messages"]["id"] ?> " class="cursor-pointer block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete</p>
                    </li>
                </ul>
            </div>
        </div>

        <div id="deleteModal<? echo $messageDetail['messages']['id'] ?> " tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <button type="button"
                        class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="deleteModal<? echo $messageDetail["messages"]["id"] ?> ">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want to delete this message?</p>
                    <div class="flex justify-center items-center space-x-4">
                        <button data-modal-toggle="deleteModal<? echo $messageDetail["messages"]["id"] ?> " type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            No, cancel
                        </button>
                        <a href="/cakephp/messages/delete/<?= $messageDetail['messages']['id'] ?>" class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                            Yes, I'm sure 
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php endif; ?>
        <?php endforeach; ?>

    </div>

    <div class=" w-full  max-w-lg  bg-white border border-gray-100 rounded-lg dark:bg-gray-800 dark:border-gray-600">
        <form id="replyForm" method="post" >
<!-- action="<?php echo $this->Html->url(array('action' => 'reply', $recipientID)); ?>" -->
            <label for="chat" class="sr-only">Your message</label>
            <div class="flex items-center px-3 py-2 rounded-lg bg-gray-50 dark:bg-gray-700">

                <input type="text" name="reply" autofocus id="chat" rows="1"
                    class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Your message..."></input>
                <button type="submit"
                    class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                    <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 18 20">
                        <path
                            d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z" />
                    </svg>
                    <span class="sr-only">Send message</span>
                </button>
            </div>
        </form>
    </div>
</section>


<script>
    
    
$(document).ready(function() {
    const messageContainer = $('#messageContainer');
    messageContainer.scrollTop(messageContainer[0].scrollHeight);

    $('#replyForm').submit((e)=> {
        e.preventDefault();

        const param = <?php echo $this->request->params['pass'][0] ?>

        $.ajax({
            url: '/cakephp/messages/reply/' + param,
            type: 'POST',
            data: {
                reply: $('#chat').val()
            },
            success: (response) => {
                response = JSON.parse(response);
                if (response.status === 'success') {
                    $('#chat').val(''); 
                    $.get('/cakephp/messages/view/' + param, (data)=> {
                        const newMessages = $(data).find('#messageContainer').html();
                        $('#messageContainer').html(newMessages);
                        messageContainer.scrollTop(messageContainer[0].scrollHeight);
                    });
                } else {
                    alert('Failed to send message.');
                }
            },
            error: function() {
                alert('Error sending message.');
            }
        });
    });

    

    // var params = <?php echo $this->request->params['pass'][0]; ?>;
    // setInterval(() => {
    //     $.get('/cakephp/messages/view/' + params, function(data) {
    //         const newMessages = $(data).find('#messageContainer').html();
    //         $('#messageContainer').html(newMessages);
    //         messageContainer.scrollTop(messageContainer[0].scrollHeight);
    //     });
    // }, 2000);
});



</script>