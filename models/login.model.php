<?php
function checkEmail(string $email) : bool
{
    global $connection;
    $statement = $connection->prepare("select * from users where email=:email;");
    $statement->execute([
        ':email'=> $email
    ]);

    return $statement->rowCount() > 0;
}

function getEmailByPinCode(int $code) : array | bool
{
    global $connection;
    $statement = $connection->prepare("select email from users where pin_code=:code;");
    $statement->execute([
        ':code'=> $code,
    ]);

    return $statement->fetch();
}

function getUserByEmail(string $email) : array
{
    global $connection;
    $statement = $connection->prepare("select * from users where email=:email;");
    $statement->execute([
        ':email'=> $email,
    ]);

    return $statement->fetch();
}

function setPinCodeByEmail(string $email, int | null $code) : bool
{
    global $connection;
    $statement = $connection->prepare("update users set pin_code = :pin_code where email=:email;");
    $statement->execute([
        ':email'=> $email,
        ':pin_code'=> $code
    ]);

    return $statement->rowCount() > 0;
}

function getPinCodeByEmail(string $email) : array
{
    global $connection;
    $statement = $connection->prepare("select pin_code from users where email=:email;");
    $statement->execute([
        ':email'=> $email
    ]);

    return $statement->fetch();
}


function updateNewPassword(string $email, string $encryptNewPass) : bool
{
    global $connection;
    $statement = $connection->prepare("update users set password = :password  where email=:email;");
    $statement->execute([
        ':email'=> $email,
        ':password'=> $encryptNewPass,
    ]);
    return $statement->rowCount() > 0;
}