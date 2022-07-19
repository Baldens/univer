<?php
    require __DIR__ . '/../../controller/IndexController.php';
    $id = (int)$_POST['id'];
    $result = (new IndexController())->selectDataStudentsInUniqGroup($id);
    $arrayData = $result->fetch_all();
    $arrHtmlEntities = [];
    for($i = 0; $i < count($arrayData); $i++){
        array_push($arrHtmlEntities,[$arrayData[$i][0],htmlentities($arrayData[$i][1]),$arrayData[$i][2]]);
    }
    echo json_encode($arrHtmlEntities,JSON_UNESCAPED_UNICODE);