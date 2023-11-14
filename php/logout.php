<?php
session_start(); // Начало сессии
session_destroy(); // Уничтожение сессии

// Очищаем все данные сессии
$_SESSION = array();

// Убеждаемся, что куки сессии тоже удалены
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}

header("Location: ./../index.html"); // Перенаправление на главную страницу после выхода
exit();
