<?php

function __autoload($classname)
{
    include "../classes/$classname.php";
}
//OBJECT OF VALIDATION CLASS
$validator = new Validator();
//NAME VALIDATION
if (isset($_POST['name'])) {
    if ($validator->validateName($_POST['name'])) {
        $name = $_POST['name'];
    } else {
        header("Location:../index.php?signupNameError=required");
        return;
    }
}
//USERNAME VALIDATION
if (isset($_POST['username'])) {
    if ($validator->validateUsername($_POST['username'])) {
        $username = $_POST['username'];
    } else {
        header("Location:../index.php?singupUsernameError=required");
        return;
    }
}

if ($validator->isUsernameExists($username)) {
    header("Location:../index.php?signupUsernameError=exists");
    return;
}
//PASSWORD VALIDATION
if (isset($_POST['password'])) {
    if ($validator->validatePassword($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        header("Location:../index.php?signupPasswordError=required");
        return;
    }
}
//EMAIL VALIDATION
if (isset($_POST['email'])) {
    if ($validator->validateEmail($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        header("Location:../index.php?signupEmailError=required");
        return;
    }
}

if ($validator->isEmailExists($email)) {
    header("Location:../index.php?signupEmailError=exists");
    return;
}

//USER REGISTRATION
$user = new Users();
$user->register($anme, $username, $email, $password);
if ($user) {
  header("Location:../index.php?signupResult=success");
  return;
} else {
  header("Location:../index.php?signupResult=fail");
}
