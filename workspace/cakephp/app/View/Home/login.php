


<div class="flex items-center flex-col justify-center min-h-screen">
    <?php echo $this->Flash->render(); ?>
    <h1 class="text-black dark:text-white text-5xl mb-10 font-medium">Login</h1>
    <form class="w-1/4 mx-auto" method="POST">
        <div class="mb-5">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
            <input name="email" type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required />
        </div>
        <div class="mb-5">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
            <input name="password" type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
        </div>


        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
        
    </form>
    <div class="flex items-start mb-5 mt-5">
        <div class="flex items-center h-5">
            <label for="terms" class="text-sm font-medium text-gray-900 dark:text-gray-300">Dont have an account? <a href="/cakephp/home/register" class="text-blue-600 hover:underline dark:text-blue-500">Register here</a></label>
        </div>
    </div>
</div>



<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#login-form").submit(function(e){
            e.preventDefault();
            
            $.ajax({
                url: "/cakephp/users/ajaxLogin",
                type: "POST",
                data: {
                    email: $("#email").val(),
                    password: $("#password").val()
                },
                success: function(response){
                    var res = JSON.parse(response);
                    if (res.status === "success") {
                        window.location.href = "/cakephp/users/index";
                    } else {
                        alert(res.message); // Display error message
                    }
                }
            });
        });
    });
</script> -->
