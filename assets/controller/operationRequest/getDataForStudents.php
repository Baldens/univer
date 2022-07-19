<?php
    require __DIR__ . '/../../controller/IndexController.php';
    $id = (int)$_POST['id'];
    $selectData = (new IndexController())->selectStudents();
    $array = $selectData->fetch_all();
    $arrHtmlEntities = [];
    for($i = 0; $i < count($array); $i++){
        array_push($arrHtmlEntities,[$array[$i][0],htmlentities($array[$i][1]),$array[$i][2]]);
    }
    echo json_encode($array[$id-1],JSON_UNESCAPED_UNICODE);
