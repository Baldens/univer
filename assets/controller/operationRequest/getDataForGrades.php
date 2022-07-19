<?php
    require __DIR__ . '/../../controller/IndexController.php';
    $whatChecked = htmlentities($_POST['whatSearch']);

    if($whatChecked == 1){
        $idSearchInArray =  (int)$_POST['idArray'];
        $selectData = (new IndexController())->selectStudentsTheirGradesAndItems();
        $array = $selectData->fetch_all();
        $arrHtmlEntities = [];
        for($i = 0; $i < count($array); $i++){
            array_push($arrHtmlEntities,[
                htmlentities($array[$i][0]),
                $array[$i][1],
                htmlentities($array[$i][2]),
                htmlentities($array[$i][3]),
                htmlentities($array[$i][4]),
            ]);
        }
        echo json_encode($arrHtmlEntities[$idSearchInArray-1],JSON_UNESCAPED_UNICODE);
    }elseif($whatChecked == 2){
        $idItems = (int)$_POST['idItems'];
        $idStudent = (int)$_POST['idStudent'];
        $selectPersonStudent = (new IndexController())->selectDataForStudentsAndTheirGrades($idStudent, $idItems);
        $arrayDataAboutGradesStudent = $selectPersonStudent->fetch_all();

        $arrHtmlEntitiesGrades = [];
        for($i = 0; $i < count($arrayDataAboutGradesStudent); $i++){
            array_push($arrHtmlEntitiesGrades,[
                htmlentities($arrayDataAboutGradesStudent[$i][0]),
                $arrayDataAboutGradesStudent[$i][1],
                htmlentities($arrayDataAboutGradesStudent[$i][2]),
                $arrayDataAboutGradesStudent[$i][3],
                htmlentities($arrayDataAboutGradesStudent[$i][4]),
                $arrayDataAboutGradesStudent[$i][5],
                htmlentities($arrayDataAboutGradesStudent[$i][6]),
            ]);
        }
        echo json_encode($arrHtmlEntitiesGrades,JSON_UNESCAPED_UNICODE);
    }
