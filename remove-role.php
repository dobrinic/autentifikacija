<?php

    require_once "core/init.php";

    Helper::getHeader('Home page');

    Helper::getNav();

    if (Input::exists('get')) {
        $role = DB::getInstance()->get('*', 'roles', ['id', '=', Input::get('id')])->first();
    }

    if (Input::exists()) {
        $role = DB::getInstance()->delete('roles', ['id', '=', Input::get('id')]);
        if (!$role->getError()) {
            header("Location: all-roles.php");
        }    
    }
?>

<div class="row">
    <div class="col-lg-6 offset-lg-3">
        <div class="card m-5">
            <h5 class="card-title p-3">Jeste li sigurni da želite obrisati rolu: <i><?php echo $role->name ?> ?</i></h5>
            <div class="card-body">
                <p>Naziv: <?php echo $role->name ?></p>
                <p>Dozvole: <?php echo $role->permissions ?></p>
                <p>Datum kreiranja: <?php echo $role->created ?></p>
            </div>
            <form method="post" class="p-3">
                <input type="hidden" name="id" value="<?php echo $role->id ?>" />
                <a href="all-roles.php" class="btn btn-warning">Nazad</a>
                <button type="submit" name="submit" class="btn btn-primary" style="float:right">Potvrdi</button>
            </form>
        </div>
    </div>
</div>

<?php
    Helper::getFooter();
?>
