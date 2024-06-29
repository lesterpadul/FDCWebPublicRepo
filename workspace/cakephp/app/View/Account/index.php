<section class="flex items-center flex-col justify-center min-h-screen ">
    <?php echo $this->Flash->render(); ?>
    <h1 class="text-black dark:text-white text-5xl mb-10 font-medium">Account</h1>
    <input type="hidden" name="update_name" value="1">
    <form class="w-1/4 mx-auto" method="post"
        action="<?php echo $this->Html->url(array('action' => 'changePassword')); ?>" enctype="multipart/form-data">

        <div class="mb-5 mt-5">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input value="<?php echo isset($user['email']) ? h($user['email']) : $currentUser['email']; ?>" type="text"
                id="email" name="email"
                class="block bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required />
            <?php if (!empty($errors['email'])): ?>
            <div class="text-red-500"><?php echo $errors['email'][0]; ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-5">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New
                password</label>
            <input type="password" id="password" name="password"
                class="block bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            <?php if (!empty($errors['password'])): ?>
            <div class="text-red-500"><?php echo $errors['password'][0]; ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-5">
            <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm
                new password</label>
            <input type="password" id="confirm_password" name="confirm_password"
                class="block bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            <?php if (!empty($errors['confirm_password'])): ?>
            <div class="text-red-500"><?php echo $errors['confirm_password'][0]; ?></div>
            <?php endif; ?>
        </div>

        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
    </form>
</section>