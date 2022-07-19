<?php
require __DIR__ . '/../../controller/IndexController.php';
$nameStudent = htmlentities($_POST['input-name-student']);
$idStudent = (int)$_POST['input-id-student'];
$array = [$idStudent,$nameStudent];
(new IndexController())->updateNameStudent($array);
header('Location: ../../students.php');