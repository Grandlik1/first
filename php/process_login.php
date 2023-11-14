<?php
include "db_connection.php"; // Подключаем файл для соединения с базой данных

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Подготовленный SQL-запрос для получения хешированного пароля из таблицы accounts
    $query = "SELECT id, password FROM accounts WHERE username = ?";

    // Используем подготовленный запрос
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $username); // "s" означает строковый тип данных

    // Выполняем запрос
    $stmt->execute();

    // Получаем результат запроса
    $stmt->bind_result($user_id, $stored_password);
    $stmt->fetch();

    // Закрываем запрос
    $stmt->close();

    if (isset($stored_password) && password_verify($password, $stored_password)) {
        // Пароль совпадает, выполняйте вход
        // Здесь можно установить сессию пользователя или выполнять другие действия

        // Активация сессии
        session_start();

        // Устанавливаем значения в сессионные переменные
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;

        // Перенаправление на index.html
        header('Location: ./../index.html');
        exit(); // Важно вызвать exit после header, чтобы прервать дальнейшее выполнение скрипта
    } else {
        // Пароль неверный, отправка сообщения об ошибке
        echo "Неверный пароль. Попробуйте ещё раз.";
    }
}