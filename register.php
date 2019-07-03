<?php

    require_once "core/init.php";

    Helper::getHeader('Home page');

    Helper::getNav();

    $validation = new Validation();

    if(Input::exists()){
        $validate = $validation->check([
            'first_name' => [
                'required'  => true,
                'min'       => 2,
                'max'       => 25
            ],
            'last_name' => [
                'required'  => true,
                'min'       => 2,
                'max'       => 25
            ],
            'username' => [
                'required'  => true,
                'min'       => 2,
                'max'       => 25,
                'unique'    => 'users'
            ],
            'password' => [
                'required'  => true,
                'min'       => 7,
                'password_condition' => true
            ],
            'confirm_password' => [
                'required'  => true,
                'matches'   => 'password'
            ]
        ]);

        if ($validate->passed()) {
            
            $salt = Hash::salt(32);
            $password = Hash::make(Input::get('password'), $salt);

            try {
                $user = DB::getInstance()->insert('users',[
                    'first_name' => Input::get('first_name'),
                    'last_name' => Input::get('last_name'),
                    'username'  => strtolower(Input::get('username')), 
                    'password'  => $password,
                    'salt'      => $salt,
                    'role_id'   => 2
                ]);
            } catch (Exception $e) {
                die($e->getMessage());
                header("Location: register.php");
                return false;
            }
            header("Location: all-users.php");
        }
    }
?>

<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <div class="card m-5">
            <h5 class="card-title p-2">Create an account</h5>
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <label class="control-label" for="first_name">First Name</label>
                        <input type="text" class="form-control <?php echo ($validation->hasError('first_name')) ? 'is-invalid' : '' ; ?>" id="first_name" name="first_name" placeholder="Enter your First Name">
                        <?php echo ($validation->hasError('first_name')) ? '<p class="text-danger"> '.$validation->hasError('first_name').'</p>' : '' ; ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="last_name">Last Name</label>
                        <input type="text" class="form-control <?php echo ($validation->hasError('last_name')) ? 'is-invalid' : '' ; ?>" id="last_name" name="last_name" placeholder="Enter your Last Name">
                        <?php echo ($validation->hasError('last_name')) ? '<p class="text-danger"> '.$validation->hasError('last_name').'</p>' : '' ; ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="username">Username</label>
                        <input type="text" class="form-control <?php echo ($validation->hasError('username')) ? 'is-invalid' : '' ; ?>" id="username" name="username" placeholder="Enter your Username">
                        <?php echo ($validation->hasError('username')) ? '<p class="text-danger"> '.$validation->hasError('username').'</p>' : '' ; ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="password">Password</label>
                        <input type="password" class="form-control <?php echo ($validation->hasError('password')) ? 'is-invalid' : '' ; ?>" id="password" name="password" placeholder="Enter your Password">
                        <?php echo ($validation->hasError('password')) ? '<p class="text-danger"> '.$validation->hasError('password').'</p>' : '' ; ?>
                    </div>
                    <div class="form-group">
						<label class="control-label" for="confirm_password">Confirm Password</label>
						<input type="password" class="form-control <?php echo ($validation->hasError('confirm_password')) ? 'is-invalid' : '' ; ?>" id="confirm_password" name="confirm_password" placeholder="Enter your password again">
						<?php echo ($validation->hasError('confirm_password')) ? '<p class="text-danger">' . $validation->hasError('confirm_password') . '</p>' : ''; ?>
					</div>
                    <a href="index.php" class="btn btn-warning">Back</a>
                    <button type="submit" class="btn btn-primary" style="float:right"   >Create an Account</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    Helper::getFooter();
?>
