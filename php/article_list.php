<?php
include "db_connection.php";

// Обработка запроса на фильтрацию и поиск
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["sortOrder"]) && isset($_GET["searchTitle"])) {
    $sortOrder = $_GET["sortOrder"];
    $searchTitle = $_GET["searchTitle"];

    // SQL-запрос для фильтрации и поиска
    $sql = "SELECT id, main_title FROM article WHERE main_title LIKE '%$searchTitle%'";

    if ($sortOrder == "asc") {
        $sql .= " ORDER BY main_title ASC";
    } elseif ($sortOrder == "desc") {
        $sql .= " ORDER BY main_title DESC";
    }

    // Выполнение запроса
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $article_id = $row["id"];
            $article_title = $row["main_title"];

            echo "<form method='post' action='/first/php/article_list.php'>";
            echo "<p>";
            echo "<a href='/first/php/view_article.php?id=$article_id&sortOrder=$sortOrder&searchTitle=$searchTitle'>$article_title</a> ";
            echo "<a href='edit_article.php?id=$article_id&sortOrder=$sortOrder&searchTitle=$searchTitle' style='color: blue;'>Редактировать</a> ";
            echo "<button type='submit' name='delete_id' value='$article_id' style='color: red;'>Удалить</button>";
            echo "</p>";
            echo "</form>";
        }} else {
        echo "Нет результатов.";
    }

    // Закрытие соединения с базой данных
    $conn->close();
} else {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Список статей</title>
    <link href="./../style/style.css" rel="stylesheet">
    <style>
        main{
            background-color: black;
            color: white;
            padding: 120px 0;

        }
        .article-list a{
            text-decoration: none;
            color: white;
            font-weight: bold;
            font-size: 20px;
        }
        .article-list{

        }

    </style>
</head>
<body>
<header>
    <marquee behavior="alternate" width="200px" style="color: #FFFFFF; text-align: center; display: flex; justify-content: center; margin: 0 auto;">Welcome</marquee>
    <div class="container">
        <div class="logo"><a href="./../index.html"><img src="./../images/Combined-Shape.svg" alt="logo"></a></div>
        <nav>
            <ul>
                <li><a href="./../featured-images.html">Featured images</a></li>
                <li><a href="./../devices.html">Gear cage</a></li>
                <li><a href="./../contact.html">Contact</a></li>
                <li><a href="./../blogs.html">Blog</a></li>
                <li><button class="open-modal-btn">Contact us</button></li>
                <li>
                    <script src="./../js/profile_menu.js"></script>
                    <div class="user-icon" onclick="toggleMenu()">
                        <img src="./../images/user_icon_inactive.svg" alt="User Icon" id="userIcon">
                        <div class="user-menu" id="userMenu">
                            <!-- Используем JavaScript для динамического управления классами -->
                            <a href="./../profile.html" id="profileBtn" class="hidden">Профиль</a>
                            <a href="./logout.php" id="logoutBtn" class="hidden">Выйти</a>
                            <a href="./../login.html" id="loginBtn" class="hidden">Войти</a>
                            <a href="./../registration.html" id="registerBtn" class="hidden">Зарегистрироваться</a>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</header>
<main>
    <div class="container">
        <div class="filter-search-container">
            <form id="filterForm">
                <label for="sortOrder">Сортировать по алфавиту:</label>
                <select id="sortOrder" name="sortOrder">
                    <option value="asc">От А до Я</option>
                    <option value="desc">От Я до А</option>
                </select>

                <label for="searchTitle">Поиск по названию:</label>
                <input type="text" id="searchTitle" name="searchTitle">

                <button type="submit">Применить</button>
            </form>
        </div>
        <div class="article-list">
            <?php


            // Обработка удаления статьи
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_id"])) {
                $article_id = $_POST["delete_id"];

                // Подготовленный запрос для удаления
                $stmt = $conn->prepare("DELETE FROM article WHERE id = ?");
                $stmt->bind_param("i", $article_id);

                if ($stmt->execute()) {
                    // Успешное удаление, выполняем редирект на страницу со списком статей
                    header("Location: /first/php/article_list.php");  // Используем абсолютный путь
                    exit();
                } else {
                    // Обработка ошибок (можно записывать в лог)
                    echo "Ошибка при удалении статьи.";
                }

                $stmt->close();
            }

            // SQL-запрос для выбора всех статей

            $sql = "SELECT id, main_title FROM article";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $article_id = $row["id"];
                    $article_title = $row["main_title"];

                    echo "<form method='post' action='/first/php/article_list.php'>";  // Используем абсолютный путь
                    echo "<p>";
                    echo "<a href='/first/php/view_article.php?id=$article_id'>$article_title</a> ";  // Используем абсолютный путь
                    echo "<a href='edit_article.php?id=$article_id' style='color: blue;'>Редактировать</a> ";
                    echo "<button type='submit' name='delete_id' value='$article_id' style='color: red;'>Удалить</button>";
                    echo "</p>";
                    echo "</form>";
                }
            } else {
                echo "Нет доступных статей.";
            }

            // Закрытие соединения с базой данных
            $conn->close();
            ?>
            <a href="./../add_article.html" class="add-article-button">Добавить статью</a>
        </div>
    </div>

</main>
<footer>
    <div class="container">\
        <div class="footer_content">
            <div class="left-block">
                <div class="logo">
                    <img src="./../images/logo-compani.svg" alt="logo">
                </div>
                <div class="logo-text">
                    Photographers & videographers capturing the world around us.
                </div>
            </div>
            <div class="right-block">
                <ul class="footer-nav">
                    <li><div class="nav-title">Pages</div></li>
                    <li class="link"><a href="#">Gear cage</a></li>
                    <li class="link"><a href="#">Featured images</a></li>
                    <li class="link"><a href="./../contact.html">Contact</a></li>
                    <li class="link"><a href="./../blogs.html">Blog</a></li>
                </ul>
            </div>
            <div class="email-footer">
                <div class="description">
                    <div class="title">Subscribe to our newsletter</div>
                    <div class="subtitle">Read about all the things we do.</div>
                </div>
                <form class="email" id="emailForm">
                    <input class="email-form" id="email-formID"  type="email" pattern="[a-zA-Z0-9._%+-]+@gmail\.com" placeholder="Email">
                    <input class=email-submit" id="footer-submit" type="submit" value="Submit">

                </form>
            </div>
            <div class="cop">
                <div class="copyright">© Aperture Photography, Inc. All rights reserved. Licensing</div>
                <div class="social">
                    <div class="logo"><a href="#"><img src="./../images/twit.svg" alt="logo"></a></div>
                    <div class="logo"><a href="#"><img src="./../images/inst.svg" alt="logo"></a></div>
                    <div class="logo"><a href="#"><img src="./../images/face.svg" alt="logo"></a></div>
                </div>
            </div>
        </div>

    </div>
</footer>
<script>
    document.getElementById("filterForm").addEventListener("submit", function (event) {
        event.preventDefault();

        // Получаем значения для фильтрации и поиска
        let sortOrder = document.getElementById("sortOrder").value;
        let searchTitle = document.getElementById("searchTitle").value;

        // Выполните запрос к серверу с использованием полученных значений
        // и обновите список статей без перезагрузки страницы
        updateArticleList(sortOrder, searchTitle);
    });

    function updateArticleList(sortOrder, searchTitle) {
        // Выполните запрос к серверу
        let url = `article_list.php?sortOrder=${sortOrder}&searchTitle=${searchTitle}`;

        fetch(url)
            .then(response => response.text())
            .then(data => {
                // Обновите содержимое списка статей
                let articleListContainer = document.querySelector(".article-list");
                articleListContainer.innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
    }
</script>
</body>
</html>
    <?php
}
?>