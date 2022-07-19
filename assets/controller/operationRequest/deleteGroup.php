<?php
require __DIR__ . '/../../controller/IndexController.php';
$idGroup = (int)$_POST['input-group-id'];
(new IndexController())->deleteGroup($idGroup);
header('Location: ../../group.php');