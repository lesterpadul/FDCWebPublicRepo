//app/View/Users/login.ctp

<!-- app/View/Users/login.ctp -->
<div class="users form">
    <?php echo $this->Flash->render('auth'); ?>
    <form method="post" action="/cakephp/users/login">
        <fieldset>
            <legend><?php echo __('Please enter your username and password'); ?></legend>
            <label for="username">Username</label>
            <input type="text" name="data[User][username]" id="username" required>
            
            <label for="password">Password</label>
            <input type="password" name="data[User][password]" id="password" required>
        </fieldset>
        <button type="submit">Login</button>
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