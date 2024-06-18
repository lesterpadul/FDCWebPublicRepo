<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: 'Roboto', sans-serif; 
            background-color: #f8f8f8;
            color: #333; 
        }

        .message-container {
            margin: 20px;
            border-radius: 10px; 
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
        }

        .message {
            margin-bottom: 10px;
            padding: 15px; 
            background-color: #fff; 
            border-radius: 8px; 
        }

        .message p {
            font-size: 16px; 
            line-height: 1.6; 
        }

        .message-actions button:hover {
            background-color: #007bff; 
            color: #fff;
            transition: background-color 0.3s ease; 
        }

        @media screen and (max-width: 768px) {
            .message {
                max-width: 80%;
            }

            .user-info img {
                width: 30px;
                height: 30px;
            }

            .message-actions button {
                padding: 8px 12px; 
            }
        }

        .show-more-less-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px; 
            border-radius: 5px; 
            cursor: pointer;
            transition: background-color 0.3s ease; 
        }

        .show-more-less-btn:hover {
            background-color: #0056b3; 
        }

        .message-container {
            display: flex;
            flex-direction: column;
        }

        .message-row {
            display: flex;
            margin: 10px 0;
        }

        .message-row.sent {
            justify-content: flex-end;
        }

        .message-row.received {
            justify-content: flex-start;
        }

        .message {
            padding: 10px;
            border-radius: 4px;
            max-width: 60%;
        }

        .message.sent {
            background-color: #dcf8c6;
            text-align: right;
        }

        .message.received {
            background-color: #f1f0f0;
            text-align: left;
        }

        .user-info {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        .user-info img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .user-info p {
            margin: 0;
            font-weight: bold;
        }

        .message-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 5px;
        }

        .message-actions button {
            margin-left: 10px;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .message-actions button.reply {
            background-color: #007bff;
            color: white;
        }

        .message-actions button.delete {
            background-color: #dc3545;
            color: white;
        }

        .show-more, .show-less {
            display: inline-block;
            text-align: center;
            margin: 20px 0;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .show-more:hover, .show-less:hover {
            background-color: #0056b3;
        }

        .meta-info {
            font-size: 0.8em;
            color: gray;
        }
        #new-message-form {
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        #new-message-form label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        #new-message-form select, 
        #new-message-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        
        #new-message-form button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        #new-message-form button[type="submit"]:hover {
            background-color: #0056b3;
        }
        .select2-container {
            width: 100% !important;
        }
        
        .select2-selection {
            border-radius: 4px;
            border: 1px solid #ccc;
            padding: 10px;
        }
        
        
    </style>
</head>
<body>

<h2>Combined Messages</h2>
<div class="message-container">
    <?php if (!empty($messages)): ?>
        <?php foreach ($messages as $message): ?>
            <div class="message-row <?php echo $message['Message']['sender_id'] == $userId ? 'sent' : 'received'; ?>">
                <div class="message <?php echo $message['Message']['sender_id'] == $userId ? 'sent' : 'received'; ?>">
                <div class="user-info">

                <?php 
                if ($message['Message']['sender_id'] == $userId) {
                    $label = 'Reply from:'; 
                    $user = $message['Recipient'];
                } else {
                    $label = 'Sent to:'; 
                    $user = $message['Sender'];
                }

                $picture = !empty($user['picture']) ? $this->Html->url('/' . h($user['picture']), true) : $this->Html->url('/path/to/default_image.jpg', true);
                ?>

                <img src="<?php echo $picture; ?>" alt="User Picture">
                <div>
                    <p><?php echo h($user['name']); ?></p>
                </div>
            </div>
            <p><?php echo h($message['Message']['message']); ?></p>
                <div class="meta-info">
                    <p><?php echo $label . ' ' . h($user['name']); ?></p>
                    <p><?php echo h($message['Message']['created']); ?></p>
                </div>
                <div class="message-actions">
                    <button class="reply" data-message-id="<?php echo $message['Message']['id']; ?>">Reply</button>
                    <button class="delete" data-message-id="<?php echo $message['Message']['id']; ?>">Delete</button>
                </div>
                <div class="reply-form-container" style="display: none;">
                    <textarea class="reply-message" placeholder="Type your reply here..." name="message"></textarea>
                    <button class="send-reply" data-message-id="<?php echo $message['Message']['id']; ?>">Send</button>
                </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No messages found.</p>
    <?php endif; ?>
</div>

<div class="show-more" id="show-more-btn">Show More</div>
<div class="show-less" id="show-less-btn" style="display: none;">Show Less</div>
<h2>Add New Message</h2>
<form id="new-message-form">
    <div>
        <label for="recipient">Recipient:</label>
        <select id="recipient" name="recipient"></select>
    </div>
    <div>
        <label for="message">Message:</label>
        <textarea id="message" name="message"></textarea>
    </div>
    <button type="submit">Send</button>
</form>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<script>
    (function() {
        initializeSelect2();
        handleShowMoreLess();
        handleNewMessageForm();

        function initializeSelect2() {
            $('#recipient').select2({
                ajax: {
                    url: '/cakephp/message/getUsers',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: data.items
                        };
                    },
                    cache: true
                },
                minimumInputLength: 1
            });
        }

        function handleShowMoreLess() {
            var messagesPerPage = 10;
            var totalMessages = <?php echo count($messages); ?>;
            var currentPage = 1;

            $('.message-row:lt(' + messagesPerPage + ')').show();

            $('#show-more-btn').on('click', function() {
                currentPage++;
                var startIndex = (currentPage - 1) * messagesPerPage;
                var endIndex = currentPage * messagesPerPage;

                $('.message-row').hide();
                $('.message-row:lt(' + endIndex + '):gt(' + (startIndex - 1) + ')').show();

                if (endIndex >= totalMessages) {
                    $('#show-more-btn').hide();
                }
                $('#show-less-btn').show();
            });

            $('#show-less-btn').on('click', function() {
                currentPage = 1;
                $('.message-row').hide();
                $('.message-row:lt(' + messagesPerPage + ')').show();
                $('#show-more-btn').show();
                $(this).hide();
            });
        }

        function handleNewMessageForm() {
            $('#new-message-form').on('submit', function(e) {
                e.preventDefault();

                var recipient = $('#recipient').val();
                var message = $('#message').val();

                $.ajax({
                    url: '/cakephp/message/message',
                    method: 'POST',
                    data: { recipient: recipient, message: message },
                    success: function(response) {
                        console.log(response);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('.message-container').on('click', '.reply-form-container .send-reply', function() {
                var messageId = $(this).data('message-id');
                var replyMessage = $(this).closest('.reply-form-container').find('.reply-message').val();

                $.ajax({
                    url: '/cakephp/message/reply',
                    method: 'POST',
                    data: { messageId: messageId, replyMessage: replyMessage },
                    success: function(response) {
                        console.log(response);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        }

        $('.message-container').on('click', '.message-actions button.reply', function() {
            var replyFormContainer = $(this).closest('.message').find('.reply-form-container');
            replyFormContainer.toggle();
        });

        $('.message-container').on('click', '.message-actions button.delete', function() {
            var messageId = $(this).data('message-id');

            $.ajax({
                url: '/cakephp/message/delete',
                method: 'POST',
                data: { messageId: messageId },
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        $(this).closest('.message-row').remove();
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    })();
</script>



</body>
</html>
