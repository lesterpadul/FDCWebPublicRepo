

<div class="flex flex-col items-center justify-center min-h-screen">
    <h1 class="text-4xl font-bold text-gray-800 mb-4">Welcome to our Polls Platform</h1>
    <p class="text-lg text-gray-600 mb-8">Get valuable insights and make data-driven decisions</p>
    <?php if (isset($_SESSION['is_logged_in'])): ?>
        <a href="?page=polls" class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-2 px-4 rounded">Checkout polls</a>
    <?php else: ?>
        <a href="?page=login" class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-2 px-4 rounded">Get Started</a>
    <?php endif; ?>


