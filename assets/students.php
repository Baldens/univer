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
    <link href="../style/commonStyle.css" rel="stylesheet">
    <link href="../style/styleForJsReplaceDataGrades.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../../js/lib/jquery-3.6.0.min.js"></script>
    <title>Студенты</title>
</head>
<body>
<?php
include 'front/mainMenu.html';
?>
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
<div class="block-student">
    <table>
        <tr>
            <th>id</th>
            <th>Имя студента</th>
            <th width="230px">Действия</th>
        </tr>
        <?php
            $mysqli = (new IndexController)->selectStudents();
            $k = 0;
            while ($row = $mysqli->fetch_row()) {
                $k = $k + 1;
                echo "<tr>";
                    echo "<td>$row[0]</td>";
                    echo "<td>" . htmlentities($row[1]) . "</td>";
                    echo "<td><button type='button' id='btn-num-$k' 
                        class='student-form__button-edit-data btn btn-primary'
                                              data-bs-toggle='modal' data-bs-target='#exampleModal'>Изменить</button> 
                        <form method='post' action='controller/operationRequest/deleteStudents.php'>
                        <input type='hidden' name='input-student-id' value='$row[0]'>
                        <button type='submit' class='group-form__button-delete-data'>Удалить</button></form></td>";
                echo "</tr>";
            }
        ?>
    </table>
</div>
<a class="url-on-other-fragment-create-new-data" href="students-add.php">Создать</a>

<script src="../../js/ajaxRequestStudents.js"></script>

</body>
</html>