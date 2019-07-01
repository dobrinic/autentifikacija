<?php

    require_once "core/init.php";

    Helper::getHeader('Home page');

    Helper::getNav();

   // $obj = DB::getInstance()->query("SELECT * FROM users WHERE id=? or id=?", array(9,12));

    if (Input::exists()) {
        $user = DB::getInstance()->insert('users',[
            'username' => Input::get('username'),
            'password' => Input::get('password'),
            'salt' => 'dfsawe',
            'first_name' => Input::get('first_name'),
            'last_name' => Input::get('last_name'),
            'role_id' => 1
        ]);

        if (!$user->getError()) {
            // obavijesti korisnika o uspješnom brisanju i preusmjeri na neku drugu stranicu
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
                        <label for="first_name">First name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter your First Name" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter your Last Name" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your Username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Create an Account</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    Helper::getFooter();
?>
