<?php

    require_once "core/init.php";

    Helper::getHeader('Home page');

    Helper::getNav();
?>

<div class="row">
    <div class="card col-lg-6 offset-lg-3">
        <h5 class="card-title">Create an account</h5>
        <div class="card-body">
            <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<?php
    Helper::getFooter();
?>

Zadatak: 
 
Napisati stranicu index.php koja prikazuje nazive dvorana iz tablice dvorana iz baze fakultet, složenih abecednim redom. Npr: 
 
A001 A002 A101