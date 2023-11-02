!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Добавить статью</title>
</head>
<body>
<header>
    <h1>Добавить статью</h1>
</header>

<div class="article-form">
    <form action="process_add_article.php" method="post" enctype="multipart/form-data">
        <label for="title">Заголовок статьи:</label>
        <input type="text" id="title" name="title" required><br><br>

        <label for="content">Содержание статьи:</label><br>
        <textarea id="content" name="content" rows="10" required></textarea><br><br>

        <!-- Элемент для выбора изображения -->
        <label for="image">Изображение:</label>
        <input type="file" id="image" name="image" accept="image/*" required><br><br>

        <input type="submit" value="Добавить статью">
    </form>
</div>
</body>
</html>
