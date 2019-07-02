<?php

    require_once "core/init.php";

    Helper::getHeader('Home page');

    Helper::getNav();

    if (Input::exists('get')) {
        $userId = Input::get('id');
        $user = DB::getInstance()->get('*', 'users', ['id', '=', $userId])->first();
    }

    if (Input::exists('post')) {

        $salt = Hash::salt(32);
        $password = Hash::make(Input::get('password'), $salt);

        $user = DB::getInstance()->update('users', Input::get('id'), [
            'username'  => strtolower(Input::get('username')), 
            'password'  => $password,
            'salt'      => $salt,
            'first_name' => Input::get('first_name'),
            'last_name' => Input::get('last_name'),
            'role_id' => 2
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
            <h5 class="card-title p-2">Uredi korisnika: <i><?php echo $user->first_name . ' ' . $user->last_name ?></i></h5>
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo $userId ?>">
                    <div class="form-group">
                        <label for="first_name">First name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $user->first_name ?>">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $user->last_name ?>">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $user->username ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $user->password ?>">
                    </div>
                    <a href="all-users.php" class="btn btn-warning">Nazad</a>
                    <button type="submit" class="btn btn-primary" style="float:right">Uredi</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    Helper::getFooter();
?>
