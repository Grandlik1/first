<?php
include "db_connection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $gender = $_POST["gender"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $favorite_style = $_POST["favorite_style"];

    // Проверка на совпадение паролей
    if ($password != $confirm_password) {
        echo "Пароли не совпадают. Попробуйте ещё раз.";
        exit;
    }

    // Хеширование пароля
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // SQL-запрос для вставки данных в таблицу accounts
    $query = "INSERT INTO accounts (username, password, gender, phone, email, favorite_style) VALUES ('$username', '$hashed_password', '$gender', '$phone', '$email', '$favorite_style')";

    if ($db->query($query) === TRUE) {
        header('Location: ./../login.html');
        exit();
    } else {
        echo "Ошибка регистрации: " . $db->error;
    }
}