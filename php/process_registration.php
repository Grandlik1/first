<?php
include "db_connection.php"; // Подключаем файл для соединения с базой данных

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Проверка на совпадение паролей
    if ($password != $confirm_password) {
        echo "Пароли не совпадают. Попробуйте ещё раз.";
        exit;
    }

    // Хеширование пароля
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // SQL-запрос для вставки данных в таблицу accounts
    $query = "INSERT INTO accounts (username, password) VALUES ('$username', '$hashed_password')";

    if ($db->query($query) === TRUE) {
        echo "Регистрация успешна. <a href='./../login.html'>Войдите</a> с вашими данными.";
    } else {
        echo "Ошибка регистрации: " . $db->error;
    }
}