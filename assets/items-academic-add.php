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
    <title>Создать новую группу</title>
</head>
<body>
<?php
include 'front/mainMenu.html';

$outputSelectGroup = (new IndexController())->selectGroups();
$outputSelectItems = (new IndexController())->selectItems();
$arraySelectGroup = $outputSelectGroup->fetch_all();
$arraySelectItems = $outputSelectItems->fetch_all();
?>
<div class="block-add-group">
    <h5>Создать новый предмет:</h5>
    <form class="form-add-group" method="POST" action="controller/operationRequest/actionAcademicItemsAdd.php">
        <span>Наименование предмета: </span>
        <input type="text" name="input-add-name-items" required>
        <button class="form-add-group__button" type="submit">Сохранить</button>
    </form>
</div>
<span class="warrior"><?php
    if(isset($_SESSION['messageOfSaveItems'])){
        echo $_SESSION['messageOfSaveItems'];
    }
    $_SESSION['messageOfSaveItems']="";
    ?></span>
<div class="block-add-group">
    <h5>Ввести новый предмет в группу:</h5>
    <form class="form-add-group" method="POST" action="controller/operationRequest/actionAddInGroupItems.php">
        <p>Выберите группу:</p>
        <select name="select-groups">
            <?php
                for($i = 0; $i < count($arraySelectGroup); $i++){
                    echo "<option value='" . $arraySelectGroup[$i][0] . "'>" . htmlentities($arraySelectGroup[$i][1]) . "</option>";
                }
            ?>
        </select>
        <p>Выберите предмет:</p>
        <select name="select-items">
            <?php
            for($i = 0; $i < count($arraySelectItems); $i++){
                echo "<option value='" . $arraySelectItems[$i][0] . "'>" . htmlentities($arraySelectItems[$i][1]) . "</option>";
            }
            ?>
        </select><br><br>
        <button class="form-add-group__button" type="submit">Сохранить</button>
    </form>
</div>
<span class="warrior"><?php
    if(isset($_SESSION['messageOfSaveInGroupItems'])){
        echo $_SESSION['messageOfSaveInGroupItems'];
    }
    $_SESSION['messageOfSaveInGroupItems']="";
    ?></span>
<script href="js/ajaxRequest.js"></script>
</body>
</html>