<section class="flex items-center flex-col justify-center min-h-screen">
   <h1 class="text-black dark:text-white text-5xl mb-10 font-medium">Messages</h1>
   <div class="relative w-full max-w-sm overflow-y-scroll bg-white border border-gray-100 rounded-lg dark:bg-gray-700 dark:border-gray-600 h-96">
      <ul>
         <?php foreach ($messages as $message): ?>
         <li class="border-b border-gray-100 dark:border-gray-600 ">
            <a href="/cakephp/messages/view/<?php echo $message['users']['id'] ?>" class="flex justify-start w-full px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-800">
               <img class="me-3 rounded-full w-11 h-11" src="<?php echo $this->Html->url('/' . $message['users']['profile_image']); ?>" alt="User Avatar">
               <div class>
                  <p class="font-semibold text-md text-gray-900 dark:text-white">
                     <?php echo $message['users']['name']; ?>
                  </p>
                  <p class="text-sm text-gray-500 dark:text-gray-400">
                     <?php if ($message['messages']['sender_id'] == $currentUserID): ?>
                     <span class="font-normal text-gray-900 dark:text-gray-200">
                     You:
                     </span>
                     <?php else: ?>
                     <span class="font-normal text-gray-900 dark:text-gray-200">
                     <?php echo $message['users']['name']; ?>:
                     </span>
                     <?php endif; ?>
                     <?php 
                        $maxLength = 35;
                        $fullMessage = $message['messages']['message'];
                        
                        if (strlen($fullMessage) > $maxLength) {
                            $shortMessage = substr($fullMessage, 0, $maxLength) . '...';
                        } else {
                            $shortMessage = $fullMessage;
                        }
                        echo $shortMessage;
                        ?>
                  </p>
                  <!-- <span class="text-xs text-blue-600 dark:text-blue-500">
                     <?php echo $message['messages']['created_at']; ?>
                     </span> -->
               </div>
            </a>
         </li>
         <?php endforeach; ?>
      </ul>
      <div id="write" class="sticky mt-auto bottom-0 left-0 z-50 w-full h-16 bg-white border-t border-gray-200 dark:bg-gray-800 dark:border-gray-600">
         <div class="grid h-full w-full max-w-lg mx-auto">
            <a href="/cakephp/messages/create" class="inline-flex items-center justify-center font-medium px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
               <svg class="w-6 h-6 mb-1 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                  <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
               </svg>
            </a>
         </div>
      </div>
   </div>
</section>