<?php
require __DIR__ . '/controller/IndexController.php';
?>
<!DOCTYPE html>
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
    <title>Группы с предметами</title>
</head>
<body>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Внести изменения в наименовании предмета</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="replace-data-about-grades__block-with-inputs-grades"></div>
            </div>
        </div>
    </div>
</div>
<div>
    <div>
        <?php
        include 'front/mainMenu.html';
        ?>
    </div>
    <div class="block-for-open-replace"></div>
    <div class="table-items-of-group">
        <div class="block-form-select">
            <form class="form-search-items-of-group" method="post">
                <select name="form-search-items__select">
                    <?php
                    $requestGroup = (new IndexController())->selectGroups();
                    $outputGetNameGroup = $requestGroup->fetch_all();
                    $requestItemsSearchForIdGroup = (new IndexController())->selectStudentTheirItems(trim(htmlentities($_POST['form-search-items__select'])));
                    for ($i = 0; $i < $requestGroup->num_rows; $i++){
                        echo "<option value='{$outputGetNameGroup[$i][0]}'>" . htmlentities($outputGetNameGroup[$i][1]) . "</option>";
                    }
                    ?>
                </select>
                <button class="btn-input-group-for-search-items" type="submit">Выбрать</button>
            </form>
        </div>
        <?php
            if($requestItemsSearchForIdGroup->num_rows > 0){
        ?>
        <table>
            <tr>
                <th>id</th>
                <th>Предмет</th>
                <th width="254px">Действия</th>
            </tr>
            <?php
            $k = 0;
            while ($row = $requestItemsSearchForIdGroup->fetch_row()) {
                $k = $k + 1;
                echo "<tr>";
                echo "<td>$row[0]</td>";
                echo "<td>" . htmlentities($row[1]) . "</td>";
                echo "<td><button type='button' id='btn-num-$k'
                                    class='items-form__button-edit-data btn btn-primary'
                                      data-bs-toggle='modal' data-bs-target='#exampleModal'
                                    >Изменить</button>
                                <form method='post' action='controller/operationRequest/deleteGroup.php'>
                                    <input type='hidden'name='input-items-id'  value='$row[0]'>
                                    <button type='submit' class='group-form__button-delete-data'>Удалить</button></td></form>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <div class="block-messages-group-items">
        <?php
            }else{
                echo "<span>Данная группа не заполненна данными, либо вы не выбрали группу!</span>";
            }
        ?><br><br>
        <a class="url-on-other-fragment-create-new-data" href="items-academic-add.php">Ввести новый предмет для группы</a>

    </div>
</div>
<script src="../../js/ajaxRequestAcademicItems.js"></script>
</body>
</html>