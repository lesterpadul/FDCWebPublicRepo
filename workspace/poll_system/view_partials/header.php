<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo isset($title) ? $title : "Poll System"; ?></title>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  	<script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
  

</head>
<body>



	<nav class="bg-gray-800">
  <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
    <div class="relative flex h-16 items-center justify-between">
   
      <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
        <div class="flex flex-shrink-0 items-center">
          <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
        </div>
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex space-x-4">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a href="?page=home" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Home</a>
			<a href="?page=polls" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Polls</a>
            <a href="?page=contact" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Stats</a>
            <a href="?page=profile" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Profile</a>
          </div>
        </div>
      </div>
      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0 gap-5">
        <?php if (isset($_SESSION['is_logged_in'])) { ?>
          <p class="text-gray-300"><?php echo $_SESSION['username']; ?></p>
        <?php } ?>
			<?php if (isset($_SESSION['is_logged_in'])) { ?>
					<a href="?page=logout" class="bg-indigo-600 border-2 border-indigo-600 hover:bg-indigo-500 text-white py-2 px-4 rounded">Logout</a>
			<?php } else { ?>
					<a href="?page=login" class="bg-indigo-600 border-2 border-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded">Login</a>
			<?php } ?>
      </div>
    </div>
  </div>

</nav>
