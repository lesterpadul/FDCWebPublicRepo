<!-- username: $("#username").val(), -->

<!-- app/View/Users/add.ctp -->


<!-- <div class="h-dvh flex justify-center items-center">
    <form class="max-w-sm p-10 rounded  text-white" method="post">
    
        <div class="mb-5">
            <label for="email" class="mb-2 text-sm font-medium text-gray-300">Name</label>
            <input type="text" id="name" name="name" class="bg-gray-700 border border-gray-600 text-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 mt-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
            <input type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required />
        </div>
        <div class="mb-5">
            <label for="email" class="mb-2 text-sm font-medium text-gray-300">Email</label>
            <input type="email" id="email" name="email" class="bg-gray-700 border border-gray-600 text-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 mt-1" required />
        </div>    
        <div class="mb-5">
            <label for="password" class="mb-2 text-sm font-medium text-gray-300">Your password</label>
            <input type="password" id="password" name="password" class="bg-gray-700 border border-gray-600 text-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 mt-1" required />
        </div>
        
        <div class="mb-5">
            <label for="confirm_password" class="mb-2 text-sm font-medium text-gray-300">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" class="bg-gray-700 border border-gray-600 text-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" required />
        </div>

        <label for="confirm_password" class="mb-2 text-sm font-medium text-gray-300">Birthdate</label>
        <div class="mb-5 relative max-w-sm">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
            </svg>
        </div>
        
        <input datepicker datepicker-autohide type="text" class="bg-gray-700 border border-gray-600 text-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" placeholder="Select date">
        </div>

        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
    </form>
</div> -->



<div class="h-96 flex justify-center items-center h-screen flex-col">
    <h1 class="text-black dark:text-white text-5xl mb-10 font-medium">Register</h1>
    <form class="max-w-sm" method="post">
        <div class="mb-5">
            <label for="email" class=" mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
            <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required />
        </div>
       <div class="mb-5">
            <label for="name" class=" mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
            <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required />
        </div>
        <div class="mb-5">
            <label for="password" class=" mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
            <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
        </div>
        <div class="mb-5">
            <label for="confirm_password" class=" mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
            <input type="password" id="confirm_password" name="confirm_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
        </div>

        <label for="birthdate" class=" mb-2 text-sm font-medium text-gray-900 dark:text-white">Birthdate</label>
        <div class="relative max-w-sm mb-5">
            
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
            </svg>
        </div>
        
        <input id="birthdate" name="birthdate" datepicker datepicker-format="yyyy/mm/dd" datepicker-autohide type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
        </div>

        
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>
</div>








<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("input[type='submit']").click(function(e){
            e.preventDefault();
            $.ajax({
                url: "/cakephp/users/ajaxAdd",
                type: "POST",
                data: {
                    password: $("#password").val(),
                    role: $("#role").val()
                },
                success: function(response){
                    var res = JSON.parse(response);
                    if (res.status == "success") {
                        alert("The user has been saved");
                    } else {
                        alert("The user could not be saved. Please, try again.");
                    }
                }
            });
        });
    });
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
       $("input[value='Login").click(function(){
            $.ajax({
                url: "/cakephp/users/ajaxLogin",
                type: "POST",
                data: {
                    username: $("input[name='data[User][username]']").val(),
                    password: $("input[name='data[User][password]']").val()
                },
                success: function(response){
                    var res = JSON.parse(response);
                    if (res.status == "success") {
                        window.location.href = "/cakephp/users/index";
                    }
                }
            });
            return false;
       });
    });

 -->

