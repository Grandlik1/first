<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Редактировать статью</title>
</head>
<body>
<header>
    <h1>Редактировать статью</h1>
</header>

<div class="article-form">
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
        $sql = "SELECT main_title, text, main_photo FROM article WHERE id = $article_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $main_title = $row["main_title"];
            $text = $row["text"];
            $main_photo = $row["main_photo"];

            echo "<form action='process_edit_article.php?id=$article_id' method='post' enctype='multipart/form-data'>";
            echo "Заголовок статьи: <input type='text' name='title' value='$main_title' required><br><br>";
            echo "Содержание статьи:<br>";
            echo "<textarea name='content' rows='10' required>$text</textarea><br><br>";
            echo "Изображение статьи: <input type='file' name='image' accept='image/*'><br><br>";
            echo "<img src='$main_photo' alt='Текущее изображение'><br><br>";
            echo "<input type='submit' value='Сохранить изменения'>";
            echo "</form>";
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
