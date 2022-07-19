$(document).ready(function () {
    var myModal = document.getElementById('myModal')
    var myInput = document.getElementById('myInput')



    let button = document.querySelectorAll('.group-form__button-edit-data');
    for (let i = 0; i < button.length; i++) {
        button[i].addEventListener('click', function (e) {
            let idButton = e.target.getAttribute('id');
            let getId = idButton.replace(/^btn-num-/, '');
            replaceWithTextInInputTd(getId);
        })
    }

    function replaceWithTextInInputTd(id) {
        $(".close-block").on('click', function () {
            $(".block-with-menu-about-student").hide();
        });
        sendAjaxForm(id, '../assets/controller/operationRequest/getDataForGroup.php', 0, '');
    }

    myModal.addEventListener('shown.bs.modal', function () {
        myInput.focus()
    })

    //1 - Мы обращаемся к таблице полной, чтобы выбрать из него id student and id предмета
    //2 - полуили выше id's мы ищем все оценки, которые он получил

    function sendAjaxForm(id, url, checkReq, htmlInputsReplace) {
        $.ajax({
            url: url,
            type: "POST",
            data: {id: id},
            success: function (request) {
                let arrayParse = JSON.parse(request);
                let htmlInputs = htmlInputsReplace;
                if (checkReq == 0) {
                    htmlInputs += `
                    <form method="post" class="replace-data-about-groups" action="controller/operationRequest/updateDataGroup.php">
                        <p>Группа: </p>
                        <input name="input-data-group" type="text" value="${arrayParse[1]}"><br>
                        <input name="input-data-id-group" type="hidden" value="${arrayParse[0]}">
                        <button type="submit" id="send-btn-${arrayParse[0]}" class="replace-data-about-groups__btn-update">Сохранить</button><br>
                    </form>
                    `;
                    sendAjaxForm(id, '../assets/controller/operationRequest/getDataStudentInUniqGroup.php', 1, htmlInputs);
                } else if (checkReq == 1) {
                    console.log(arrayParse.length)
                    if(arrayParse.length != null){
                        htmlInputs += `<p>Имена студентов:</p>`;
                        for (let k = 0; k < arrayParse.length; k++) {
                            htmlInputs += `
                            <form method="post" class="form-save-name-student" action="../assets/controller/operationRequest/updateNamesStudents.php">
                                <input type="text" name="input-name-student" value="${arrayParse[k][1]}">
                                <input type="hidden" name="input-id-student" value="${arrayParse[k][0]}"><br>
                                <button type="submit" class="form-save-name-student__button">Сохранить</button>
                            </form>
                           
                        `;
                        }
                    }
                }
                let htmlStudentsOutputOnDisplay = '';
                $('.replace-data-about-grades__block-with-inputs-grades').html(htmlInputs);
            },
            error: function () {
                alert('Error');
            }
        })
    }

    let buttonUpdate = document.querySelectorAll('.btn-update');
    for (let i = 0; i < buttonUpdate.length; i++) {
        buttonUpdate[i].addEventListener('click', function (e) {
            let idButton = e.target.getAttribute('id');
            let getId = idButton.replace(/^send-btn-/, '');
            // replaceWithTextInInputTd(getId);
        })
    }

})

