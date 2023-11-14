<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Просмотр статьи</title>
</head>
<body>
<header>
    <h1>Просмотр статьи</h1>
</header>

<div class="article-content">
    <?php
    if (isset($_GET['id'])) {
        // Подключение к базе данных (используем стандартные данные)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "my_site";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Ошибка подключения: " . $conn->connect_error);
        }

        $article_id = $_GET['id'];

        // SQL-запрос для выбора статьи по идентификатору
        $sql = "SELECT main_title, main_photo, text FROM article WHERE id = $article_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            echo "<h2>" . $row["main_title"] . "</h2>";
            echo "<img src='" . $row["main_photo"] . "' alt='Изображение статьи'>";
            echo "<p>" . $row["text"] . "</p>";
        } else {
            echo "Статья не найдена.";
        }

        $conn->close();
    } else {
        echo "Неверный идентификатор статьи.";
    }
    ?>
</div>
</body>
</html>
