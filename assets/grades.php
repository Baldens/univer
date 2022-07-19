<?php
require __DIR__ . '/controller/IndexController.php';
?>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../style/styleFragmentGroup.css" rel="stylesheet">
        <link href="../style/styleForJsReplaceDataGrades.css" rel="stylesheet">
        <script src="../../js/lib/jquery-3.6.0.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <title>Оценки учащихся</title>
    </head>
    <body>
    <div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="replace-data-about-grades__block-with-inputs-grades"></div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <?php
                include 'front/mainMenu.html';
            ?>
        </div>
        <div class="block-for-open-replace"></div>
        <div class="table-with-data-student-grades-items-button_delete-button_replace">
            <?php
                $outputRequestSqlItems = (new IndexController())->selectStudentsTheirGradesAndItems();
            ?>
            <table>
                <tr>
                    <th>Баллы</th>
                    <th>Студенты (id)</th>
                    <th>Предметы (id)</th>
                    <th width="214px">Действия</th>
                </tr>
                <?php
                    $arrayDataStudentAndGrades = $outputRequestSqlItems->fetch_all();
                    for ($i = 0; $i < $outputRequestSqlItems->num_rows; $i++){
                        echo "<tr>";

                            echo "<td>" . ($arrayDataStudentAndGrades[$i][2]) . "</td>";

                            echo "<td>" .
                                htmlentities($arrayDataStudentAndGrades[$i][0]) .
                                " (" . $arrayDataStudentAndGrades[$i][1] . ")" .
                                "</td>";

                            echo "<td>" .
                                htmlentities($arrayDataStudentAndGrades[$i][3]) .
                                " (" . $arrayDataStudentAndGrades[$i][4] . ")" .
                                "</td>";

                            echo "<td><form method='post' action='controller/operationRequest/deleteGradesStudent.php'>
                                    <input type='hidden' name='input-student-id' value='" . $arrayDataStudentAndGrades[$i][1] . "'>
                                    <input type='hidden' name='input-items-id' value='" . $arrayDataStudentAndGrades[$i][4] . "'>
                                    <button type='submit' class='grades-form__button-delete-data'>Удалить</button></form>
                                    <button type='button' id='btn-num-" . ($i+1) . "' class='grades-form__button-edit-data btn btn-primary'
                                      data-bs-toggle='modal' data-bs-target='#exampleModal'>Изменить</button></td>";

                        echo "</tr>";
                    }
                ?>
            </table>
        </div>
        <div>
            <a class="url-on-other-fragment-create-new-data" href="grades-add.php">Создать</a>
        </div>
    </div>
    <script src="../../js/ajaxRequest.js" crossorigin="anonymous"></script>
    </body>
    </html>
