<?php
    session_start();
    require __DIR__ . '/../../controller/IndexController.php';
    $inputDataGroup = (int)$_POST['select-groups'];
    $inputDataItems = (int)$_POST['select-items'];
    if($inputDataGroup != null && $inputDataItems != null){
        $existence = (new IndexController())->checkOnExistenceItemsInGroup($inputDataItems,$inputDataGroup);
        if($existence != 0){
            $_SESSION['messageOfSaveInGroupItems'] = "Данные есть в базе данных.";
        }else{
            (new IndexController())->saveDataItemsInGroup($inputDataGroup,$inputDataItems);
            $_SESSION['messageOfSaveInGroupItems'] = "Добавлена в базу данных.";
        }
    }
    header('Location: ../../items-academic-add.php');
