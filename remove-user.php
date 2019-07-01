<?php

    require_once "core/init.php";

    Helper::getHeader('Home page');

    Helper::getNav();

    if (Input::exists('get')) {
        $userId = Input::get('id');
        $user = DB::getInstance()->get('*', 'users', ['id', '=', $userId])->first();
    }

    if (Input::exists()) {
        $userId = Input::get('id');
        $user = DB::getInstance()->delete('users', ['id', '=', $userId]);
        if (!$user->getError()) {
            // obavijesti korisnika o uspješnom brisanju i preusmjeri na neku drugu stranicu
            header("Location: all-users.php");
        }
    }
?>

<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <div class="card m-5">
            <h5 class="card-title p-2">Jeste li sigurni da želite obrisati korisnika: <i><?php echo $user->first_name . ' ' . $user->last_name ?></i></h5>
            <div class="card-body">
                <p>Ime: <?php echo $user->first_name ?></p>
                <p>Prezime: <?php echo $user->last_name ?></p>
                <p>Rola: <?php echo $user->role_id ?></p>
                <p>Username: <?php echo $user->username ?></p>
                <p>Datum Registracije: <?php echo $user->joined ?></p>
            </div>
            <form method="post" class="p-3">
                <input type="hidden" name="id" value="<?php echo $userId ?>">
                <a href="all-users.php" class="btn btn-warning">Nazad</a>
                <button type="submit" name="submit" class="btn btn-primary" style="float:right">Potvrdi</button>
            </form>
        </div>
    </div>
</div>

<?php
    Helper::getFooter();
?>
