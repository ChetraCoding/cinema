<?php
require "models/login.model.php";
$errors = [];

if (! isset($_SESSION['pin_code'])) {
    require 'views/errors/404.php';
    die();
}

$email = getEmailByPinCode($_SESSION['pin_code'])['email'];
if (!$email) {
    session_destroy();
    header("Location: /login");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    strlen($_POST['new-password']) >= 8 ? "" : $errors['new_password'] = "Please enter password at least 8 characters.";
    $_POST['new-password'] == $_POST['confirm-password'] ? "" : $errors['confirm_password'] = "Incorrect password.";

    if (empty($errors)) {
        $encryptNewPass = password_hash($_POST['new-password'], PASSWORD_BCRYPT);
        updateNewPassword($email, $encryptNewPass);
        setPinCodeByEmail($email, null);
        session_destroy();
        header("Location: /login");
    }
}

require "views/recoverpassword/recoverpassword.view.php";