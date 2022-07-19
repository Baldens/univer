<?php
session_start();
require __DIR__ . '/controller/IndexController.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../style/commonStyle.css" rel="stylesheet">
    <script href="../js/lib/jquery-3.6.0.min.js"></script>
    <title>Добавить новую оценку учащиемуся</title>
</head>
<body>

<header>
    <?php
    include 'front/mainMenu.html';
    $controller = new IndexController();

    $selectItems = $controller->selectGroups();
    $reqItems = $selectItems->fetch_all();
    ?>
</header>
<div>
    <div class="elem_menu">
        <h3>Оценки</h3>
    </div>
    <div class="form-filling">
        <form method="POST" сlass="form-save-grades" id="form-save-grades-unq" action="new-grades.php">

            <span>Выберите группу, в которую хотите внести новые данные с оценками:</span>
            <select name="input-list-groups" class="form-save-grades__input-list-items">
                <?php
                for ($i = 0; $i < $selectItems->num_rows; $i++){
                    echo "<option value=" . $reqItems[$i][0] . ">" . htmlentities($reqItems[$i][1]) . "</option>";
                }
                ?>
            </select><br><br>
            <button type="submit" class="form-save-grades__button">Отправить</button>
        </form>
    </div>
</div>
<script href="../js/ajaxRequest.js"></script>
</body>
</html>