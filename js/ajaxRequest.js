$(document).ready(function (){
    var myModal = document.getElementById('myModal')
    var myInput = document.getElementById('myInput')

    let button = document.querySelectorAll('.grades-form__button-edit-data');
    for (let i = 0; i < button.length; i++){
        button[i].addEventListener('click', function (e){
            let idButton = e.target.getAttribute('id');
            let getId = idButton.replace(/^btn-num-/,'');
            replaceWithTextInInputTd(getId);
        })
    }


    $('.close-block').click(function (){
        $('.block-with-menu-about-student').css('display', 'none');
    });

    function replaceWithTextInInputTd(id){
        blockWithReplaceData = `
            <div class="block-with-menu-about-student">
                <button type="button" class="close-block">Закрыть</button>
<!--                <form method="post" class="replace-data-about-grades" action="../assets/controller/operationRequest/updateDataAboutGradesStudent.php">-->
                    <div class="replace-data-about-grades__block-with-inputs-grades">
                    </div>
<!--                    <input type="button" value="Сохранить" class="replace-data-about-grades__button">-->
<!--                </form>-->
            </div>
        `;
        let arrayRequest = {whatSearch: 1, idArray: id};
        sendAjaxForm(arrayRequest,'../assets/controller/operationRequest/getDataForGrades.php');
        $(".close-block").on('click', function () {
            $(".block-with-menu-about-student").hide();
        });
    }
    myModal.addEventListener('shown.bs.modal', function () {
        myInput.focus()
    })
    //1 - Мы обращаемся к таблице полной, чтобы выбрать из него id student and id предмета
    //2 - полуили выше id's мы ищем все оценки, которые он получил

    function sendAjaxForm(arrayRequest,url){
        $.ajax({
            url: url,
            type: "POST",
            data: arrayRequest,
            success: function (request){
                let arrayParse = JSON.parse(request);
                let arrayRequestAboutStudent = {whatSearch: 2, idItems:arrayParse[4] , idStudent: arrayParse[1]};
                if(arrayRequest['whatSearch']==1){
                    sendAjaxForm(arrayRequestAboutStudent,'../assets/controller/operationRequest/getDataForGrades.php')
                }else{
                    let htmlInputs = `<span>Имя: </span><span>${arrayParse[0][0]}</span><br>
                    <span>Предмет: </span><span>${arrayParse[0][2]}</span><p>Оценки:</p><br>`;
                    for (let i = 0; i < arrayParse.length; i++){
                        let splitDate = arrayParse[i][4].split(' ');
                        htmlInputs += `
                            <form method="post" class="replace-data-about-grades" action="controller/operationRequest/updateDataAboutGradesStudent.php">
                                <p>Дата: ${splitDate[0]}</p>
                                <input name="input-data-grades" type="text" value="${arrayParse[i][6]}">
                                <input name="input-data-id-grades" type="hidden" value="${arrayParse[i][5]}">
                                <button type="submit" class="replace-data-about-grades__button" id="send-btn-${arrayParse[i][5]}" class="btn-update">Отправить</button><br>
                            </form>
                        `;
                    }
                    $('.replace-data-about-grades__block-with-inputs-grades').html(htmlInputs);
                }
            }
        })
    }

    // let buttonUpdate = document.querySelectorAll('.btn-update');
    // for (let i = 0; i < button.length; i++){
    //     buttonUpdate[i].addEventListener('click', function (e){
    //         let idButton = e.target.getAttribute('id');
    //         let getId = idButton.replace(/^send-btn-/,'');
    //         replaceWithTextInInputTd(getId);
    //     })
    // }
})
