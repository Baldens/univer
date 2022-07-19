<?php
    require __DIR__ . '/../../controller/IndexController.php';
    $nameItem = htmlentities($_POST['input-name-acad-items']);
    $idItem = (int)$_POST['input-id-acad-items'];
    $array = [$idItem, $nameItem];
    (new IndexController())->updateNameItems($array);
    header('Location: ../../groups-items.php');