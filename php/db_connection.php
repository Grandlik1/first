<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "my_site";

// Подключение к базе данных
$conn = new mysqli($hostname, $username, $password, $database);
$db = new mysqli($hostname, $username, $password, $database);
// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}