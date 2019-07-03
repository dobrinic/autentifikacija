<?php

    require_once "core/init.php";

    Helper::getHeader('Home page');

    Helper::getNav();

    $roles = DB::getInstance()->get('*', 'roles')->results();
  
?>

<div class="row">
    <div class="col-lg-10 offset-lg-1">
        <div class="card m-5">
            <h5 class="card-title p-3">Sve Role
                <a href="create-role.php" style="float:right" class="btn btn-warning">Kreiraj novu Rolu</a>
            </h5>
            <div class="card-body">
                <table class="table table-hover">
                    <tr>
                        <th>R.B.</th>
                        <th>Naziv</th>
                        <th>Dozvole</th>
                        <th>Datum kreiranja</th>
                        <th>Akcija</th>
                    </tr>

                    <?php

                    foreach ($roles as $key => $role) {
                        echo
                        "<tr>
                            <td>".$role->id."</td>
                            <td><a href='show-role.php?id=".$role->id."'>".$role->name."</a></td>
                            <td>".$role->permissions."</td>
                            <td>".$role->created."</td>
                            <td width='200'>
                                <a href='show-role.php?id=".$role->id."'><button type='button' class='btn btn-primary btn-sm' >Prikaži</button></a>
                                <a href='edit-role.php?id=".$role->id."'><button type='button' class='btn btn-success btn-sm' >Uredi</button></a>
                                <a href='remove-role.php?id=".$role->id."'><button type='button' class='btn btn-danger btn-sm' >Obriši</button></a>
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
