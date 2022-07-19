<?php
    require __DIR__ . '/../../controller/IndexController.php';
    $nameGroup = htmlentities($_POST['input-data-group']);
    $idGroup = (int)$_POST['input-data-id-group'];
    $array = [$idGroup,$nameGroup];
    (new IndexController())->updateNameGroup($array);
    header('Location: ../../group.php');