<?php
    require __DIR__ . '/../../controller/IndexController.php';
    $idStudent = (int)$_POST['input-student-id'];
    $idItems = (int)$_POST['input-items-id'];
    (new IndexController())->deleteGradesStudent($idStudent,$idItems);
    header('Location: ../../grades.php');