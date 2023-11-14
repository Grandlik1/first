<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "my_site";

// Подключение к базе данных
$db = new mysqli($hostname, $username, $password, $database);

// Проверка подключения
if ($db->connect_error) {
    die("Ошибка подключения к базе данных: " . $db->connect_error);
}