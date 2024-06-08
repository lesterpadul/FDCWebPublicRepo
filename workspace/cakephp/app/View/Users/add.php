<!-- app/View/Users/add.ctp -->
<div class="users ">
    <form action="" method="post">
        <fieldset>
            <legend>Add User</legend>
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
            <br>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <br>
            <label for="role">Role</label>
            <select name="role" id="role">
                <option value="admin">Admin</option>
                <option value="author">Author</option>
            </select>
        </fieldset>
        <br>
        <input type="submit" value="Submit">
    </form>
</div>