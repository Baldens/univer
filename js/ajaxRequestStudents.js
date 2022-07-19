$(document).ready(function (){
    var myModal = document.getElementById('myModal')
    var myInput = document.getElementById('myInput')

    let button = document.querySelectorAll('.student-form__button-edit-data');
    for (let i = 0; i < button.length; i++){
        button[i].addEventListener('click', function (e){
            let idButton = e.target.getAttribute('id');
            let getId = idButton.replace(/^btn-num-/,'');
            replaceWithTextInInputTd(getId);
        })
    }

    function replaceWithTextInInputTd(id){
        let arrayRequest = {id: id};
        sendAjaxForm(arrayRequest,'../assets/controller/operationRequest/getDataForStudents.php');
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
                let htmlInputs = `
                    <form method="post" class="replace-data-about-grades" 
                        action="controller/operationRequest/updateNameStudentInUrlStudents.php">
                        <span>Имя: </span><input type="text" 
                        name="input-name-student" value="${arrayParse[1]}">
                        <input name="input-id-student" type="hidden" value="${arrayParse[0]}">
                        <button type="submit" class="replace-data-about-student__button" id="send-btn" 
                        class="btn-update">Обновить</button><br>
                    </form>`;
                $('.replace-data-about-grades__block-with-inputs-grades').html(htmlInputs);
            }
        })
    }
})
