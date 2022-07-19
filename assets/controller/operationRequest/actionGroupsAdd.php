<?php
    session_start();
    require __DIR__ . '/../../controller/IndexController.php';
    $inputDataSaveNewGroups = trim(htmlentities($_POST['input-add-name-group']));
    if($inputDataSaveNewGroups == null){
        $_SESSION['message'] = "Вернул данные с ошибкой. Вы не заполнили поле";
        header('Location: ../../groups-add.php');
    }else{
        (new IndexController())->saveDataGroups($inputDataSaveNewGroups);
        header('Location: ../../group.php');
    }