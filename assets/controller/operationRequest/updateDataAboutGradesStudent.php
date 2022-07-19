<?php
    require __DIR__ . '/../../controller/IndexController.php';
    $gradesUpdate = htmlentities($_POST['input-data-grades']);
    $idGrades = (int)$_POST['input-data-id-grades'];
    $arrayRequest = [$gradesUpdate,$idGrades];
    $selectData = (new IndexController())->updateNewDataGradesStudents($arrayRequest);
    header('Location: ../../grades.php');