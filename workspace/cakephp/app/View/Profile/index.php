<section class="flex items-center flex-col justify-center min-h-screen pt-36 pb-8">
    <?php echo $this->Flash->render(); ?>
    <h1 class="text-black dark:text-white text-5xl mb-10 font-medium">Profile</h1>
        <input type="hidden" name="update_name" value="1">
    <form class="w-1/4 mx-auto" method="post" action="<?php echo $this->Html->url(array('action' => 'updateProfile')); ?>" enctype="multipart/form-data">
        

       
<img class="rounded w-32 h-32 mx-auto" src="<?php echo !empty($user['profile_image']) ? $this->Html->url('/' . $user['profile_image']) : $this->Html->url('/' . $currentUser['profile_image']); ?>" alt="Profile Image">
        
    

        <div class="mb-5">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="profile_image">Upload file</label>
            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="profile_image" type="file" name="profile_image">
        </div>

        <div class="mb-5 mt-5">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
            <input value="<?php echo isset($user['name']) ? h($user['name']) : $currentUser['name']; ?>" type="text" id="name" name="name" class="block bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
            <?php if (!empty($errors['name'])): ?>
                <div class="text-red-500"><?php echo $errors['name'][0]; ?></div>
            <?php endif; ?>
        </div>

        <label for="birthdate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birthdate</label>
        <div class="relative max-w-sm mb-5">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                </svg>
            </div>
            <input id="birthdate" name="birthdate" datepicker datepicker-format="yyyy/mm/dd" datepicker-autohide type="text" value="<?php echo isset($user['birthdate']) ? h($user['birthdate']) : $currentUser['birthdate']; ?>>" class="block bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
        </div>

        <div class="mb-5">
            <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
            <div class="flex items-center justify-evenly mb-4">
                <div>
                    <input id="male" type="radio" value="M" name="gender" class="p-2 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                    <?php echo (isset($user['gender']) && $user['gender'] == 'M') ? 'checked' : ($currentUser['gender'] == 'M' ? 'checked' : ''); ?>>
                    <label for="male" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Male</label>
                </div>
                
                <div>
                    <input id="female" type="radio" value="F" name="gender" class="p-2 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                    <?php echo (isset($user['gender']) && $user['gender'] == 'F') ? 'checked' : ($currentUser['gender'] == 'F' ? 'checked' : ''); ?>>
                    <label for="female" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Female</label>
                </div>
            </div>
        </div>

        <div class="mb-5">
            <label for="hobby" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hobby</label>
            <textarea name="hobby" id="hobby" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your hobbies here..."><?php echo isset($user['hobby']) ? h($user['hobby']) : $currentUser['hobby']; ?></textarea>
        </div>

        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
    </form>
</section>
