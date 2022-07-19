<?php
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
?>
    <div class="block-add-group">
        <form class="form-add-group" method="POST" action="controller/operationRequest/actionGroupsAdd.php">
            <span>Наименование группы </span>
            <input type="text" name="input-add-name-group" required>
            <button class="form-add-group__button" type="submit">Сохранить</button>
        </form>
    </div>
    <span class="warrior"><?php
        if(isset($_SESSION['message'])){
            echo $_SESSION['message'];
        }
        $_SESSION['message']="";
        ?></span>
    <script href="js/ajaxRequest.js"></script>
</body>
</html>