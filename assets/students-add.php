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
    <link href="../style/styleFragmentGroup.css" rel="stylesheet">
    <title>Создать нового студента</title>
</head>
<body>
<?php
include 'front/mainMenu.html';
?>
<div class="block-add-student">
    <form class="form-add-student" method="POST" action="controller/operationRequest/actionStudentAdd.php">
        <span>Внести нового студента в базу данных</span><br><br>
        <input type="text" name="input-add-name-student" required>
        <select name="groups" class="form-group__select-list-groups">
            <?php
            $outputSqlRequestSelectGroups = (new IndexController())->selectGroups();
            $arraySqlRequestSelectGroups = $outputSqlRequestSelectGroups->fetch_all();
            for ($i = 0; $i < $outputSqlRequestSelectGroups->num_rows; $i++){
                echo "<option value='" . $arraySqlRequestSelectGroups[$i][0] ."'>" . htmlentities($arraySqlRequestSelectGroups[$i][1]) . "</option>";
            }
            $arrayNumLinkedWithGradesItem = [];
            ?>
        </select><br><br>
        <button class="form-add-student__button" type="submit">Сохранить</button>
    </form>
    <span class="warrior"><?php
        if(isset($_SESSION['message'])){
            echo $_SESSION['message'];
        }
        $_SESSION['message']="";
        ?></span>
</div>
</body>
</html>