<?php
    session_start();
    require __DIR__ . '/../../controller/IndexController.php';
    $inputData = trim(htmlentities($_POST['input-add-name-items']));

    if($inputData != null){
        $existence = (new IndexController())->checkOnExistenceItems($inputData);
        if($existence != 0){
            $_SESSION['messageOfSaveItems'] = "Данный предмет есть в базе данных!";
        }else{
            (new IndexController())->saveDataItems($inputData);
            $_SESSION['messageOfSaveItems'] = "Данный предмет добавлен в базу данных!";
        }
    }
    header('Location: ../../items-academic-add.php');
