<?php echo $this->Flash->render(); ?>

<div class="container d-flex justify-content-center">
    <div class="row justify-content-center w-100 login-container">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark">
                    <h3>Registration Form</h3>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="name">Username</label>
                            <input type="text" name="username" class="form-control" required>

                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="user_password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>