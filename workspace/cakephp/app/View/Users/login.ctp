
<?php echo $this->Flash->render(); ?>

<section class="container d-flex justify-content-center">
  <div class="row justify-content-center login-container w-100">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header bg-dark">
          <h3>Login Form</h3>
        </div>
        <div class="card-body">
          <div class="text-center mb-4">
            <img src="./img/signin-image-rafiki.png" alt="Sign In image" class="img-fluid" style="max-width: 150px;">
          </div>
          <form action="" method="POST">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>