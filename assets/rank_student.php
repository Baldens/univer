<?php
    require __DIR__ . '/controller/IndexController.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../style/styleFragmentGroup.css" rel="stylesheet">
    <title>Рейтинг студентов</title>
</head>
<body>


<?php
    $checkedSelectOption = $_POST['groups'];
    if($checkedSelectOption==""){
        $checkedSelectOption = 0;
    }

    $outputRequestSqlItems = (new IndexController())->selectStudentTheirItems($checkedSelectOption);
    $outputSqlRequestSelectGroups = (new IndexController())->selectGroups();
    $outputRequestStudentsAndGrades = (new IndexController())->selectStudentsAndGrades($checkedSelectOption);
    $outputRequestGrades = (new IndexController())->selectGradesStudentsWithParamIdStudentIdGroup($checkedSelectOption);
    $arrayGrades = $outputRequestGrades->fetch_all();
    $array = $outputRequestSqlItems->fetch_all();
?>
    <header>
        <?php
        include 'front/mainMenu.html';
        ?>
    </header>
<div>
    <div class="block-group">
        <span class="span-main-text-group">Группа</span>
        <form method="POST" class="form-group">
            <select name="groups" class="form-group__select-list-groups">
                <?php
                $arraySqlRequestSelectGroups = $outputSqlRequestSelectGroups->fetch_all();
                for ($i = 0; $i < $outputSqlRequestSelectGroups->num_rows; $i++){
                    echo "<option value='" . $arraySqlRequestSelectGroups[$i][0] ."'>" . htmlentities($arraySqlRequestSelectGroups[$i][1]) . "</option>";
                }
                $arrayNumLinkedWithGradesItem = [];
                ?>
            </select>
            <input type="submit" class="form-group__button" value="Построить рейтинг">
        </form>
    </div>

    <div class="div-table-rank-student">
        <?php
        if($checkedSelectOption!=""){

        ?>
        <form method="POST">
            <table>
                <tr>
                    <?php
                        echo "<th>Студенты</th>";
                        for ($i = 0; $i < $outputRequestSqlItems->num_rows; $i++){
                            $arr = array($i => $array[$i][0]);
                            array_push($arrayNumLinkedWithGradesItem,$arr);
                            echo "<th>" . htmlentities($array[$i][1]) . "</th>";
                        }
                    ?>
                </tr>
                <?php

                $saveStopWhileItems = 0;
                for ($i = 0; $i < $outputRequestGrades->num_rows; $i++){
                    if($arrayGrades[$i-1][4] == $arrayGrades[$i][4]){
                        for($k = $saveStopWhileItems; $k < count($array); $k++){
                            if($arrayGrades[$i][1]==$array[$k][0]){
                                echo "<td>". htmlentities($arrayGrades[$i][3]) ."</td>";
                                $saveStopWhileItems = $k + 1;
                                break;
                            }else{
                                echo "<td>-</td>";
                            }
                        }
                    }else{
                        if($saveStopWhileItems > 0){
                            for ($j = $saveStopWhileItems; $j < count($array); $j++){
                                echo "<td>-</td>";
                            }
                        }
                        echo "<tr>";
                        echo "<td>". htmlentities($arrayGrades[$i][7]) ."</td>";
                        for($k = 0; $k < count($array); $k++){
                            if($arrayGrades[$i][1]==$array[$k][0]){
                                echo "<td>". htmlentities($arrayGrades[$i][3]) ."</td>";
                                $saveStopWhileItems = $k + 1;
                                break;
                            }else{
                                echo "<td>-</td>";
                            }
                        }
                    }
                }
                ?>
            </table>
        </form>
            <?php
        }else{
            echo "<span>Выберите группу!</span>";
        }
        ?>
    </div>
</div>
</body>
</html>