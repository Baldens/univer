<?php
    require __DIR__ . '/../../controller/IndexController.php';
    $idItems = (int)$_POST['input-items-id'];
    (new IndexController())->deleteAcademicItems($idItems);
    header('Location: ../../groups-items.php');