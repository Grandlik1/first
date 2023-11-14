<?php

session_start();

// проверяется, установлен ли пользовательский идентификатор в сессии
$sessionActive = isset($_SESSION['user_id']);

// Возвращаем результат в формате JSON
header('Content-Type: application/json');
echo json_encode(array('sessionActive' => $sessionActive));
