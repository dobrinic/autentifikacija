<?php

    require_once "core/init.php";

    Helper::getHeader('Home page');

    Helper::getNav();


    if (Input::exists('get')) {
        $role = DB::getInstance()->get('*', 'roles', ['id', '=', Input::get('id')])->first();
    }
?>

<div class="row">
    <div class="col-lg-6 offset-lg-3">
        <div class="card m-5">
            <h5 class="card-title p-3">Informacije o roli: <i><?php echo $role->name ?></i></h5>
            <div class="card-body">
                <p>Naziv: <?php echo $role->name ?></p>
                <p>Dozvole: <?php echo $role->permissions ?></p>
                <p>Datum kreiranja: <?php echo $role->created ?></p>
                <a href="all-roles.php" class="btn btn-warning">Nazad</a>
            </div>
        </div>
    </div>
</div>

<?php
    Helper::getFooter();
?>
