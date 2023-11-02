<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Список статей</title>
</head>
<body>
<header>
    <h1>Список статей</h1>
</header>

<div class="article-list">
    <?php
    // Подключение к базе данных (используем стандартные данные)
    $servername = "localhost"; // Стандартный хост (локальный сервер)
    $username = "root"; // Стандартное имя пользователя (обычно root для локального сервера)
    $password = ""; // Пароль (обычно пустой для локального сервера)
    $dbname = "article"; // Название базы данных (article)

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверка подключения
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    // SQL-запрос для выбора всех статей
    $sql = "SELECT id, main_title FROM article";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $article_id = $row["id"];
            $article_title = $row["main_title"];

            echo "<p>";
            echo "<a href='view_article.php?id=$article_id'>$article_title</a> ";
            echo "<a href='edit_article.php?id=$article_id' style='color: blue;'>Редактировать</a> ";
            echo "<a href='delete_article.php?id=$article_id' style='color: red;'>Удалить</a>";
            echo "</p>";
        }
    } else {
        echo "Нет доступных статей.";
    }
    echo "<a href='./../add_article.html'>Добавить статью</a>";
    // Закрытие соединения с базой данных
    $conn->close();
    ?>
</div>
</body>
</html>