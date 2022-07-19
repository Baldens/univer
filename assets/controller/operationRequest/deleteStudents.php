<?php
require __DIR__ . '/../../controller/IndexController.php';
$idGroup = (int)$_POST['input-student-id'];
(new IndexController())->deleteStudents($idGroup);
header('Location: ../../students.php');