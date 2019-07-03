<?php

    require_once "core/init.php";

    Helper::getHeader('Home page');

    Helper::getNav();

    if (Input::exists('get')) {
        $role = DB::getInstance()->get('*', 'roles', ['id', '=', Input::get('id')])->first();
    }

    if (Input::exists()) {
        $role = DB::getInstance()->update('roles', Input::get('id'),[
            'name' => Input::get('name'),
            'permissions' => Input::get('permissions')
        ]);

        if (!$role->getError()) {
            header("Location: all-roles.php");
        }
    }
?>

<div class="row">
    <div class="col-lg-6 offset-lg-3">
        <div class="card m-5">
        <h5 class="card-title p-3">Uredite Rolu: <i><?php echo $role->name ?></i></h5>
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo $role->id ?>" />
                    <div class="form-group">
                        <label for="name">Naziv</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $role->name ?>">
                    </div>
                    <div class="form-group">
                        <label for="permissions">Dozvole</label>
                        <input type="text" class="form-control" id="permissions" name="permissions" value="<?php echo $role->permissions ?>">
                    </div>
                    <a href="all-roles.php" class="btn btn-warning">Nazad</a>
                    <button type="submit" class="btn btn-primary" style="float:right">Ažuriraj</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    Helper::getFooter();
?>
