



<?php echo $this->Flash->render(); ?>
<div class="h-dvh flex justify-center items-center">
    <form class="max-w-sm border p-10 rounded" method="post" action="/cakephp/users/login">
    <div class="mb-5">
        <label for="email" class=" mb-2 text-sm font-medium text-gray-900">Username</label>
        <input type="text" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  w-full p-2.5" name="data[User][username]" required />
    </div>
    <div class="mb-5">
        <label for="password" class=" mb-2 text-sm font-medium text-gray-900">Password</label>
        <input type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  w-full p-2.5" name="data[User][password]" required />
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Login</button>
</form>
</div>






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
</script>