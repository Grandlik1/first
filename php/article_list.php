<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Список статей</title>
    <link href="./../style/style.css" rel="stylesheet">
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
        <div class="article-list">
            <?php
            // Данные для подключения к базе данных
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "my_site";

            // Создание соединения
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Проверка соединения
            if ($conn->connect_error) {
                die("Ошибка подключения: " . $conn->connect_error);
            }


            // Обработка удаления статьи
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_id"])) {
                $article_id = $_POST["delete_id"];

                // Подготовленный запрос для удаления
                $stmt = $conn->prepare("DELETE FROM article WHERE id = ?");
                $stmt->bind_param("i", $article_id);

                if ($stmt->execute()) {
                    // Успешное удаление, выполняем редирект на страницу со списком статей
                    header("Location: /first/php/article_list.php");
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

                    echo "<p>";
                    echo "<a href='./php/view_article.php?id=$article_id'>$article_title</a> ";
                    echo "<a href='./php/edit_article.php?id=$article_id' style='color: blue;'>Редактировать</a> ";
                    echo "<form method='post' action='article_list.php' style='display: inline;'>";
                    echo "<button type='submit' name='delete_id' value='$article_id' style='color: red;' onclick='return confirm(\"Вы уверены, что хотите удалить статью?\");'>Удалить</button>";
                    echo "</form>";
                    echo "</p>";
                }
            } else {
                echo "Нет доступных статей.";
            }

            // Закрытие соединения с базой данных
            $conn->close();
            ?>
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
</body>
</html>