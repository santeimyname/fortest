function DoSave() {
    var dataofuser = new Array();
    dataofuser['id'] = document.getElementById('id').value;
    dataofuser['iname'] = document.getElementById('CustName').value;
    dataofuser['fname'] = document.getElementById('CustFam').value;
    dataofuser['dep'] = document.getElementById('CustDep').value;
    dataofuser['post'] = document.getElementById('CustPost').value;
    $.ajax({
        type: "POST",
        url: "app/include/functions.php",
        data: {
            'dataofuser': {
                iname: dataofuser['iname'],
                fname: dataofuser['fname'],
                dep: dataofuser['dep'],
                post: dataofuser['post'],
                id: dataofuser['id']
            },
            'action': "doSaveUser"
        },
        dataType: 'json'
    }).done(function (data) {
        if (data = 1) {
            alert('Выполнено успешно!');
            document.location.href = "/users.php";
        }
        else {
            alert('Ошибка сохранения')
        }
        console.log(data);
    });
}

function DoRemove() {
    var isYes = confirm("Вы действительно хотите удалить запись о пользователе?");
    if (isYes) {
        var dataofuser = document.getElementById('id').value;
        $.ajax({
            type: "POST",
            url: "app/include/functions.php",
            data: {
                'dataofuser': dataofuser,
                'action': "doRemoveUser"
            },
            dataType: 'json'
        }).done(function (data) {
            if (data = 1) {
                alert('Выполнено успешно!');
                document.location.href = "/users.php";
            }
            else {
                alert('Ошибка выполнения')
            }
            console.log(data);
        });
    }
}

function DoRemoveUser() {
    var checkboxes = document.getElementsByName('checkbox');
    var checkboxesChecked = [];
    for (var index = 0; index < checkboxes.length; index++) {
        if (checkboxes[index].checked) {
            checkboxesChecked.push(checkboxes[index].value);
        }
    }
    console.log(checkboxesChecked);
    var isYes = confirm("Вы действительно хотите удалить записи?");
    if (isYes) {
        $.ajax({
            type: "POST",
            url: "app/include/functions.php",
            data: {
                'dataofuser': checkboxesChecked,
                'action': "doRemoveUser"
            },
            dataType: 'json'

        }).done(function (data) {
            if (data = 1) {
                alert('Выполнено успешно!');
                document.location.href = "/users.php";
            }
            else {
                alert('Ошибка выполнения')
            }
            console.log(data);
        });
    }
}

function DoRemoveTask() {
    var checkboxes = document.getElementsByName('checkbox');
    var checkboxesChecked = [];
    for (var index = 0; index < checkboxes.length; index++) {
        if (checkboxes[index].checked) {
            checkboxesChecked.push(checkboxes[index].value);
        }
    }
    console.log(checkboxesChecked);
    var isYes = confirm("Вы действительно хотите удалить записи?");
    if (isYes) {
        $.ajax({
            type: "POST",
            url: "app/include/functions.php",
            data: {
                'dataoftask': checkboxesChecked,
                'action': "doRemoveTask"
            },
            dataType: 'json'
        }).done(function (data) {
            if (data = 1) {
                alert('Выполнено успешно!');
                document.location.href = "/tasks.php";
            }
            else {
                alert('Ошибка выполнения')
            }
            console.log(data);
        });
    }
}
function DoRemoveT() {
    var isYes = confirm("Вы действительно хотите удалить запись?");
    if (isYes) {
        var dataoftask = document.getElementById('id').value;
        $.ajax({
            type: "POST",
            url: "app/include/functions.php",
            data: {
                'dataoftask': dataoftask,
                'action': "doRemoveTask"
            },
            dataType: 'json'
        }).done(function (data) {
            if (data = 1) {
                alert('Выполнено успешно!');
                document.location.href = "/tasks.php";
            }
            else {
                alert('Ошибка выполнения')
            }
            console.log(data);
        });
    }
}

function DoSaveTask() {
    var dataoftask = [];
    dataoftask['id'] = document.getElementById('id').value;
    dataoftask['Text'] = document.getElementById('Text').value;
    dataoftask['IdUser'] = document.getElementById('listuser').value;
    dataoftask['Status'] = document.getElementById('liststatus').value;
    Data = new Date();
    Year = Data.getFullYear();
    Month = Data.getMonth();
    Day = Data.getDate();
    Hour = Data.getHours();
    Minutes = Data.getMinutes();
    Seconds = Data.getSeconds();
    dataoftask['Created'] = Year + "-" + Month + "-" + Day + " " + Hour + ":" + Minutes + ":" + Seconds;
    $.ajax({
        type: "POST",
        url: "app/include/functions.php",
        data: {
            'dataoftask': {
                id: dataoftask['id'],
                Text: dataoftask['Text'],
                IdUser: dataoftask['IdUser'],
                Status: dataoftask['Status'],
                Created: dataoftask['Created'],
            },
            'action': "doSaveTask"
        },
        dataType: 'json'
    }).done(function (data) {
        if (data = 1) {
            alert('Выполнено успешно!');
            document.location.href = "/tasks.php";
        }
        else {
            alert('Ошибка сохранения')
        }
        console.log(data);
    });
}

function DoResetTask() {

    document.getElementById('ftask').value = '';
    document.getElementById('fuser').value = '';
    document.getElementById('fliststatus').value = 1;
    document.getElementById('fdatefrom').value = '';
    document.getElementById('fdateto').value = '';
    document.location.href = "/tasks.php";

}

