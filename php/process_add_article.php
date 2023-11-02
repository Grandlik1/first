<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Получение данных из формы
    $title = $_POST["title"];
    $content = $_POST["content"];

    // Обработка изображения
    $target_directory = "uploads/"; // Папка для сохранения загруженных изображений
    $target_file = $target_directory . basename($_FILES["image"]["name"]);

    // Проверка и сохранение изображения
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Изображение успешно загружено
    } else {
        echo "Произошла ошибка при загрузке изображения.";
    }

    // SQL-запрос для добавления новой статьи в таблицу article
    $sql = "INSERT INTO article (main_title, text, main_photo) VALUES ('$title', '$content', '$target_file')";

    if ($conn->query($sql) === TRUE) {
        header("Location: article_list.php"); // Перенаправление на страницу списка статей
        exit();
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }

    // Закрытие соединения с базой данных
    $conn->close();
}