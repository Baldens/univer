<?php
session_start();
    require __DIR__ . '/../IndexController.php';

    $arrayInputData = [
        (int)$_POST['input-grades'],
        (int)$_POST['input-list-name_student'],
        trim($_POST['input-list-items'])
    ];
    if($arrayInputData[2] == ""){
        $_SESSION['messageAboutNullGrades'] = "Введена пустое поле!";
        header('Location: ../../grades-add.php');
    }else if(is_int($arrayInputData[2])==false) {
        $_SESSION['messageAboutNullGrades'] = "Введено число не целое!";
        header('Location: ../../grades-add.php');
    }else{
        $contr = new IndexController();
        $contr->saveDataGradesStudents($arrayInputData);
        $_SESSION['messageAboutNullGrades'] = "Успешно добавлена оценка!";
        header('Location: ../../grades-add.php');
    }