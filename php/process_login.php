<?php
include "db_connection.php"; // Подключаем файл для соединения с базой данных

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // SQL-запрос для получения хешированного пароля из таблицы accounts
    $query = "SELECT password FROM accounts WHERE username = '$username'";
    $result = $db->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stored_password = $row["password"];

        // Проверка пароля
        if (password_verify($password, $stored_password)) {
            // Пароль совпадает, выполняйте вход
            // Здесь можно установить сеанс пользователя или выполнять другие действия
            echo "Вход выполнен успешно.";
        } else {
            echo "Неверный пароль. Попробуйте ещё раз.";
        }
    } else {
        echo "Пользователь с таким именем не найден.";
    }
}