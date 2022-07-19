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

    $selectStudents = $controller->selectStudentForGroup($_POST['input-list-groups']);
    $req = $selectStudents->fetch_all();

    $selectItems = $controller->selectItemsForGroup($_POST['input-list-groups']);
    $reqItems = $selectItems->fetch_all();
    ?>
</header>
<div>
    <div class="elem_menu">
        <h3>Оценки</h3>
    </div>
    <div class="form-filling">
        <form method="POST" сlass="form-save-grades" id="form-save-grades-unq" action="controller/operationRequest/actionGradesAdd.php">

            <span>Оценка</span>
            <input type="number" name="input-grades" class="form-save-grades__input-grades"><br>
            <span>Студент</span>

            <select class="form-save-grades__input-list-name_student" name="input-list-name_student">
                <?php

                for ($i = 0; $i < $selectStudents->num_rows; $i++){
                    echo "<option value=" . $req[$i][0] . ">" . htmlentities($req[$i][1]) . "</option>";
                }
                ?>
            </select><br>

            <span>Предмет</span>
            <select name="input-list-items" class="form-save-grades__input-list-items">
                <?php

                for ($i = 0; $i < $selectItems->num_rows; $i++){
                    echo "<option value=" . $reqItems[$i][0] . ">" . htmlentities($reqItems[$i][1]) . "</option>";
                }
                ?>
            </select><br>
            <button type="submit" class="form-save-grades__button">Отправить</button>
        </form>

    </div>
</div>
<script href="../js/ajaxRequest.js"></script>
</body>
</html>