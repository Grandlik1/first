<?php
// Подключение к базе данных
include "db_connection.php";

    // Проверка, был ли передан идентификатор статьи
    if (isset($_GET['article_id'])) {
        // Получение идентификатора статьи из запроса
        $article_id = $_GET['article_id'];

        // Подготовка SQL-запроса для удаления статьи
        $sql = "DELETE FROM articles WHERE id = $article_id";

        // Выполнение запроса
        if ($db->query($sql) === TRUE) {
            echo "Статья успешно удалена";

            // Переход на страницу article_list.html
            header('Location: /first/php/article_list.php');
            exit(); // Важно вызвать exit после header, чтобы прервать дальнейшее выполнение скрипта
        } else {
            echo "Ошибка при удалении статьи: " . $db->error;
        }
    } else {
        echo "Не передан идентификатор статьи для удаления";
    }

// Закрытие соединения с базой данных
    $db->close();;


