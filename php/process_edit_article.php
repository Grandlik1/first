<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_GET['id'])) {
        $article_id = $_GET['id'];

        // Подключение к базе данных (используем стандартные данные)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "my_site";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Проверка подключения
        if ($conn->connect_error) {
            die("Ошибка подключения: " . $conn->connect_error);
        }

        // Получение данных из формы
        $title = $_POST["title"];
        $content = $_POST["content"];

        // Проверка наличия новой фотографии
        if (!empty($_FILES["image"]["name"])) {
            // Обработка изображения и замена старой фотографии на новую
            $target_directory = "uploads/";
            $target_file = $target_directory . basename($_FILES["image"]["name"]);

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Изображение успешно загружено, обновите значение main_photo в базе данных
                $main_photo = $target_file;
                $sql = "UPDATE article SET main_title = '$title', text = '$content', main_photo = '$main_photo' WHERE id = $article_id";
            } else {
                echo "Произошла ошибка при загрузке изображения.";
                exit();
            }
        } else {
            // Если новая фотография не выбрана, обновите только заголовок и текст
            $sql = "UPDATE article SET main_title = '$title', text = '$content' WHERE id = $article_id";
        }

        if ($conn->query($sql) === TRUE) {
            // После успешного обновления, перенаправьте пользователя на страницу редактирования этой статьи
            header("Location: first/php/edit_article.php?id=$article_id");
            exit();
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }

        // Закрытие соединения с базой данных
        $conn->close();
    } else {
        echo "Неверный идентификатор статьи.";
    }
}

