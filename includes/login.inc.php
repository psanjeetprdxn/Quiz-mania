<?php

function __autoload($classname)
{
    include "../classes/$classname.php";
}
//OBJECT OF VALIDATION CLASS
$validator = new Validator();
//USERNAME VALIDATION
if (isset($_POST['username'])) {
    if ($validator->validateUsername($_POST['username'])) {
        $username = $_POST['username'];
    } else {
        header("Location:../index.php?loginUsernameError=required");
        return;
    }
}
//PASSWORD VALIDATION
if (isset($_POST['password'])) {
    if ($validator->validatePassword($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        header("Location:../index.php?loginPasswordError=required");
        return;
    }
}

//LOGIN
$user = new Users();
$user->login($username, $password);
