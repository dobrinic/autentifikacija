<?php

    require_once "core/init.php";

    Helper::getHeader('Home page');

    Helper::getNav();

    $validation = new Validation();

    if (Input::exists()) {
        $validate = $validation->check([
            'name' => [
                'required'  => true,
                'min'       => 3,
                'max'       => 25
            ],
            'permissions' => [
                'required'  => true,
                'min'       => 3,
                'max'       => 25,
                'unique'    => 'roles'
            ]
        ]);
        if ($validate->passed()) {
            
            $role = DB::getInstance()->insert('roles',[
                'name' => Input::get('name'),
                'permissions' => Input::get('permissions')
            ]);

            if (!$role->getError()) {
                header("Location: all-roles.php");
            }
        }
    }
?>

<div class="row">
    <div class="col-lg-6 offset-lg-3">
        <div class="card m-5">
            <h5 class="card-title p-3">Kreiraj novu Rolu</h5>
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <label for="name">Naziv</label>
                        <input type="text" class="form-control <?php echo ($validation->hasError('name')) ? 'is-invalid' : '' ; ?>" id="name" name="name" placeholder="Upišite Naziv role">
                        <?php echo ($validation->hasError('name')) ? '<p class="text-danger"> '.$validation->hasError('name').'</p>' : '' ; ?>
                    </div>
                    <div class="form-group">
                        <label for="permissions">Dozvole</label>
                        <input type="text" class="form-control <?php echo ($validation->hasError('permissions')) ? 'is-invalid' : '' ; ?>" id="permissions" name="permissions" placeholder="Upišite dozvloe za rolu">
                        <?php echo ($validation->hasError('permissions')) ? '<p class="text-danger"> '.$validation->hasError('permissions').'</p>' : '' ; ?>
                    </div>
                    <a href="all-roles.php" class="btn btn-warning">Nazad</a>
                    <button type="submit" class="btn btn-primary" style="float:right">Kreiraj</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    Helper::getFooter();
?>
