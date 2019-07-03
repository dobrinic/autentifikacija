<?php

    require_once "core/init.php";

    Helper::getHeader('Home page');

    Helper::getNav();

    $users = DB::getInstance()->get('*', 'users')->results();
    //$users = DB::getInstance()->query('SELECT users.id, first_name, last_name, username, roles.name AS rola, joined  FROM users JOIN roles ON users.role_id = roles.id')->results();

?>

<div class="row">
    <div class="col-lg-12">
        <div class="card m-5">
            <h5 class="card-title p-2">Korisnici</h5>
            <div class="card-body">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th>Username</th>
                        <th>Rola</th>
                        <th>Datum Registracije</th>
                        <th>Akcija</th>
                    </tr>
                    <?php
                        foreach ($users as $user) {
                            $rola = DB::getInstance()->get('name', 'roles', ['id', '=', $user->role_id])->first();
                            echo
                                "<tr>
                                    <td>$user->id</td>
                                    <td>$user->first_name</td>
                                    <td>$user->last_name</td>
                                    <td>$user->username</td>
                                    <td>$rola->name</td>
                                    <td>$user->joined</td>
                                    <td width=200>
                                        <a href='show-user.php?id=$user->id'><button class='btn btn-primary btn-sm'>Prikaži</button></a>
                                        <a href='edit-user.php?id=$user->id'><button class='btn btn-success btn-sm'>Uredi</button></a>
                                        <a href='remove-user.php?id=$user->id'><button class='btn btn-danger btn-sm'>Obriši</button></a>
                                    </td>
                                </tr>";
                        }
                    ?>
                </table>
           
            </div>
        </div>
    </div>
</div>

<?php
    Helper::getFooter();
?>
