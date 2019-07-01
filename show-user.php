<?php

    require_once "core/init.php";

    Helper::getHeader('Home page');

    Helper::getNav();

    if (Input::exists('get')) {
        $userId = Input::get('id');
        $user = DB::getInstance()->get('*', 'users', ['id', '=', $userId])->first();
    }
?>

<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <div class="card m-5">
            <h5 class="card-title p-2">Informacije o korisniku: <i><?php echo $user->first_name . ' ' . $user->last_name ?></i></h5>
            <div class="card-body">
                <p>Ime: <?php echo $user->first_name ?></p>
                <p>Prezime: <?php echo $user->last_name ?></p>
                <p>Rola: <?php echo $user->role_id ?></p>
                <p>Username: <?php echo $user->username ?></p>
                <p>Datum Registracije: <?php echo $user->joined ?></p>
                <a href="all-users.php" class="btn btn-warning">Nazad</a>
            </div>
        </div>
    </div>
</div>

<?php
    Helper::getFooter();
?>
