<?php
$dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4";
$connection = new PDO($dsn, $DB_USER, $DB_PASSWORD);