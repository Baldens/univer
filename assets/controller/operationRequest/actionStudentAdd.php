<?php
    session_start();
    require __DIR__ . '/../../controller/IndexController.php';
    $inputDataSaveNewStudent= trim(htmlentities($_POST['input-add-name-student']));
    $inputIdGroup = (int)$_POST['groups'];
    if($inputDataSaveNewStudent == null){
        $_SESSION['message'] = "Вернул данные с ошибкой. Вы не заполнили поле";
        header('Location: ../../students-add.php');
    }else{
        (new IndexController())->saveDataNewStudent($inputDataSaveNewStudent,$inputIdGroup);
        header('Location: ../../students.php');
    }
