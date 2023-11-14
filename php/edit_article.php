<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Редактировать статью</title>
    <link href="./../style/style.css" rel="stylesheet">
    <style>
        main{
            background-color: black;
            color: white;
            padding: 60px 0;

        }
        .container{
            overflow: hidden;
        }
        main form {
            display: flex;
            flex-direction: column;
        }
        main img {
            width: 100%;
            height: 500px;
        }
        main  input , textarea  {

            padding: 10px;

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
                            <a href="../profile.html" id="profileBtn" class="hidden">Профиль</a>
                            <a href="./logout.php" id="logoutBtn" class="hidden">Выйти</a>
                            <a href="../login.html" id="loginBtn" class="hidden">Войти</a>
                            <a href="../registration.html" id="registerBtn" class="hidden">Зарегистрироваться</a>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</header>
<main>
    <div class="container">
        <div class="article-form">
            <h1>Редактирование статьи</h1>
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
                    echo "<img src='$main_photo' alt='Текущее изображение'><br><br>";
                    echo "Заголовок статьи: <input type='text' name='title' value='$main_title' required><br><br>";
                    echo "Содержание статьи:<br>";
                    echo "<textarea name='content' rows='10' required>$text</textarea><br><br>";
                    echo "Изображение статьи:<input type='file' name='image' accept='image/*'><br><br>";
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
