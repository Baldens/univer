<?php
    require __DIR__ . '/assets/controller/IndexController.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style/commonStyle.css" rel="stylesheet">
    <script href="js/lib/jquery-3.6.0.min.js"></script>
    <title>Welcome</title>
</head>
<body>

    <header>
        <?php
            include 'assets/front/mainMenu.html';
        ?>
    </header>
    <div class="main-block-text">
        <div class="elem_menu">
            <h5>Добро пожаловать, в студенческий дневник.</h5>
        </div>
        <div>
            <p>Данный сайт хочет, показать вам функционал для преподователей:</p>
            <li>
                <ul>Добавлять, изменять и удалять данные с таблиц: оценки, студенты, предметы и группы.</ul>
                <ul>Предоставлены сложные запросы</ul>
                <ul>Приятный и удобный интерфейс.</ul>
                <ul>Наверху есть меню, по которому пользователь, может перемещаться по страницам данного сайта.</ul>
            </li>
        </div>
    </div>
    <script href="js/ajaxRequest.js"></script>
</body>
</html>