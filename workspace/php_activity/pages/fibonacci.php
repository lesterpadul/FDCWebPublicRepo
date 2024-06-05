<?php

if (isset($_POST['int'])) {
    $input = $_POST['int'];

    $i;
    $n = $input;
    $fib = [0, 1];

    for ($i = 2; $i < $n; $i++) {
        $fib[$i] = $fib[$i - 1] + $fib[$i - 2];
    }

}



?>

<h1 class="text-center text-5xl">Fibonacci Sequence</h1><form class="max-w-sm mx-auto mt-10" method="POST">
<div class="mb-5">
<label for="text" class="block mb-2 text-sm font-medium text-gray-900 ">Your number</label>
<input type="text" id="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500" name="int" required />
</div>

<button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

</form>

<div class="mt-5 flex flex-col items-center">

<?php if (!empty($fib)): ?>
        <h2 class="text-lg font-semibold text-gray-900">Sequence</h2>
        <ul class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg ">
        <?php foreach ($fib as $f): ?>

                <li class="w-full px-4 py-2 border-b border-gray-200 ">
                <?php echo $f; ?>
                </li>
        <?php endforeach; ?>
        </ul>
<?php endif ?>

</div>