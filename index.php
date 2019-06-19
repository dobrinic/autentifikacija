<?php

    require_once "core/init.php";

    $db = DB::getInstance();

    $db->insert('users', [
        'username' => 'alex',
        'password' => '1232edsasfwe',
        'salt' => 'dfsawe',
        'first_name' => 'Aleksandar',
        'last_name' => 'Dobrinic',
        'role_id' => 1
    ]);


    Helper::getHeader('Home page');

    Helper::getNav();
?>

<div class="row">
    <div class="col-xs-12 col-md-8 col-lg-6 offset-md-2 offset-lg-3">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo Config::get('app')['name'] ?></h1>
            <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <a class="btn btn-primary btn-lg" href="login.php" role="button">Sign In</a>
            <a class="btn btn-primary btn-lg" href="register.php" role="button">Create an Account</a>
        </div>
    </div>
</div>

<?php
    Helper::getFooter();
?>