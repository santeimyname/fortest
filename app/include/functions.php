<?php

if (isset($_POST['action'])) {
    /**
     * Выбор нужного экшена из пост массива
     *
     *
     */
    switch ($_POST['action']) {
        case "doSaveUser": {
            doSaveUser($_POST['dataofuser']);
            break;
        }
        case "doRemoveUser": {
            doRemoveUser($_POST['dataofuser']);
            break;
        }
        case "doSaveTask": {
            doSaveTask($_POST['dataoftask']);
            break;
        }
        case "doRemoveTask": {
            doRemoveTask($_POST['dataoftask']);
            break;
        }
        case "doFilterTask": {
            get_tasklist($_POST['dataoftask']);
            break;
        }
    }
}

function get_users()
    /**
     * получаем список сотрудников
     */
{
    global $link;
    $sql = 'SELECT * FROM users';
    $result = mysqli_query($link, $sql);


    $data = mysqli_fetch_all($result, 1);
    return $data;
}

function get_user_name($id)
    /**
     * получаем имя сотрудника по id
     */
{
    if ($id > 0) {
        global $link;
        $sql = 'SELECT * FROM users WHERE id=' . $id;
        $result = mysqli_query($link, $sql);
        $data = mysqli_fetch_all($result, 1);
        return $data[0]["Iname"] . ' ' . $data[0]["Fname"];
    } else {
        return $data[0]['fname'] = 'Не определен';
    }
}

function get_user($id)
    /**
     * получаем данные сотрудника по id
     */
{
    global $link;
    if ($id > 0) {
        $sql = 'SELECT * FROM users WHERE id=' . $id;
        $result = mysqli_query($link, $sql);
        $data = mysqli_fetch_all($result, 1);
    } else {
        $data['fname'] = 'Не назначена';
    }
    return $data;
}

function get_status($id)
    /**
     * получаем статус по id
     */
{
    global $link;
    if ($id > 0) {
        $sql = 'SELECT * FROM status WHERE id=' . $id;
        $result = mysqli_query($link, $sql);
        $data = mysqli_fetch_all($result, 1);
        return $data;
    }

}

function get_status_list()
    /**
     * получаем весь список статусов
     */
{
    global $link;
    $sql = 'SELECT * FROM status';
    $result = mysqli_query($link, $sql);
    $data = mysqli_fetch_all($result, 1);
    return $data;

}

function get_task($id)
    /**
     * получаем данные задачи по id
     */
{
    global $link;
    if ($id > 0) {
        $sql = 'SELECT * FROM tasklist WHERE id=' . $id;
        $result = mysqli_query($link, $sql);


        $data = mysqli_fetch_all($result, 1);
        return $data;
    }
}

function get_tasklist($dataoftask)
    /**
     * получаем данные - список задач по указанным параметрам фильтрации
     */
{
    $link = mysqli_connect('localhost', 'root', 'root', 'ktteam');
    $count = 0;
    /**
     * получаем данные - список задач по указанным параметрам фильтрации
     */
    foreach ($dataoftask as $condition) {
        if ($condition != '') {
            $count++;
        }
    }
    if ($cont = 0) { //если условий нет - просто все записи
        $sql = 'SELECT * FROM tasklist';
    } else {

        $sql = "SELECT * FROM tasklist WHERE ";
        $where = [];
        /**
         * собираем массив на услови where - если есть параметр текст задачи
         */
        if (isset($dataoftask['ftask']) && ($dataoftask['ftask'] != '')) {
            $where[] = " Text like '%" . $dataoftask['ftask'] . "%'";
        }
        /**
         * собираем массив на услови where - если есть параметр исполнитель
         */
        if (isset($dataoftask['fuser']) && ($dataoftask['fuser'] != '')) {
            $where[] = " IdUser in (SELECT id FROM users  where `Iname` like '%" . $dataoftask['fuser'] . "%' or `Fname` like '%" . $dataoftask['fuser'] . "%')";
        }
        /**
         * собираем массив на услови where - если есть параметр дата заявки созданной в диапазоне с и по
         */
        if (isset($dataoftask['fdateto']) && ($dataoftask['fdateto'] != '') && (isset($dataoftask['fdatefrom']) && ($dataoftask['fdatefrom'] != ''))) {
            $where[] = " Created between '" . $dataoftask['fdatefrom'] . ' 00:00:00' . "' and  '" . $dataoftask['fdateto'] . ' 23:59:59' . "'";
        }
        /**
         * собираем массив на услови where - если есть параметр статус заявки
         */
        if (isset($dataoftask['fliststatus']) &&  // если статус указан не любой и есть еще доп условия
            ($dataoftask['fliststatus'] != '-1') && (count($where) > 0)
        ) {
            $where[] = ' Status=' . $dataoftask['fliststatus'];
        }
        if (isset($dataoftask['fliststatus']) && // если статус указан как любой и есть еще доп условия
            ($dataoftask['fliststatus'] == '-1') && (count($where) > 0)
        ) {
            $where[] = '  Status in(1,2,3,4) ';
        }
        if (isset($dataoftask['fliststatus']) && // если статус указан как любой и условий болше нет
            ($dataoftask['fliststatus'] == '-1') && (count($where) == 0)
        ) {
            $sql = 'SELECT * FROM tasklist';
        }
        if (isset($dataoftask['fliststatus']) &&  // если статус указан не любой и условий болше нет
            ($dataoftask['fliststatus'] != '-1') && (count($where) == 0)
        ) {
            $where[] = ' Status=' . $dataoftask['fliststatus'];
        }

        if (count($where) >= 1) {
            $sql .= ' 1 ';
            foreach ($where as $wh) {
                $sql .= ' and ' . $wh;
            }
        } else {
            $sql = 'SELECT * FROM tasklist';
        }
    }

    $result = mysqli_query($link, $sql);
    $data = mysqli_fetch_all($result, 1);
    return $data;

}

function count_new_task()
    /**
     * посчитать количество новых заявк
     */
{
    global $link;
    $sql = 'SELECT count(id) as kol_vo FROM tasklist WHERE status=1';
    $result = mysqli_query($link, $sql);
    $data = mysqli_fetch_all($result, 1);
    return $data[0]['kol_vo'];
}

function count_work_task()
    /**
     * посчитать количество заявок в работе
     */
{
    global $link;
    $sql = 'SELECT count(id) as kol_vo FROM tasklist WHERE status=2';
    $result = mysqli_query($link, $sql);
    $data = mysqli_fetch_all($result, 1);
    return $data[0]['kol_vo'];
}

function count_ended_task()
    /**
     * посчитать количество завершенных заявок
     */
{
    global $link;
    $sql = 'SELECT count(id) as kol_vo FROM tasklist WHERE status=3';
    $result = mysqli_query($link, $sql);
    $data = mysqli_fetch_all($result, 1);
    return $data[0]['kol_vo'];
}

function count_pause_task()
    /**
     * посчитать количество приостановленных заявок
     */
{
    global $link;
    $sql = 'SELECT count(id) as kol_vo FROM tasklist WHERE status=4';
    $result = mysqli_query($link, $sql);
    $data = mysqli_fetch_all($result, 1);
    return $data[0]['kol_vo'];
}

function doSaveUser($dataofuser)
    /**
     * сохранить данные пользователя
     */
{
    global $link;
    $link = mysqli_connect('localhost', 'root', 'root', 'ktteam');
    if ($dataofuser['id'] > 0) {
        /**
         * если ид уже есть - обновить
         */
        $sql = 'UPDATE users SET Iname="' . $dataofuser['iname'] . '", Fname="' . $dataofuser['fname'] . '",Department="' . $dataofuser['dep'] . '",Post="' . $dataofuser['post'] . '" WHERE id=' . $dataofuser['id'];
        if (mysqli_query($link, $sql)) {
            $answ = 1;
        } else {
            $answ = 2;
        }
    } else {
        /**
         * иначе вставить запись
         */
        $sql = 'INSERT INTO users (Iname,Fname,Department,Post) VALUES
   ("' . $dataofuser['iname'] . '",
    "' . $dataofuser['fname'] . '",
    "' . $dataofuser['dep'] . '",
    "' . $dataofuser['post'] . '")';
        if (mysqli_query($link, $sql)) {
            $answ = 1;
        } else {
            $answ = 2;
        }
    }
    echo $answ;
}

function doRemoveUser($dataofuser)
    /**
     * удалить сотрудников
     */
{
    $link = mysqli_connect('localhost', 'root', 'root', 'ktteam');
    if (is_array($dataofuser)) {
        $str = implode(',', $dataofuser);
        $sql = 'DELETE FROM users WHERE ID in (' . $str . ')';
        if (mysqli_query($link, $sql)) {
            $answ = 1;
        } else {
            $answ = 2;
        }
    } else {
        if ($dataofuser > 0) {
            $sql = 'DELETE FROM users WHERE ID =' . $dataofuser;
            if (mysqli_query($link, $sql)) {
                $answ = 1;
            } else {
                $answ = 2;
            }
        }
    }
    echo $answ;
}

function doRemoveTask($dataoftask)
    /**
     * удалить задачу
     */
{
    $link = mysqli_connect('localhost', 'root', 'root', 'ktteam');
    if (is_array($dataoftask)) {
        $str = implode(',', $dataoftask);
        $sql = 'DELETE FROM tasklist WHERE ID in (' . $str . ')';
        if (mysqli_query($link, $sql)) {
            $answ = 1;
        } else {
            $answ = 2;
        }
    } else {
        if ($dataoftask > 0) {
            $sql = 'DELETE FROM tasklist WHERE ID =' . $dataoftask;
            if (mysqli_query($link, $sql)) {
                $answ = 1;
            } else {
                $answ = 2;
            }
        }
    }
    echo $answ;
}

function doSaveTask($dataoftask)
    /**
     * сохранить задачу
     */
{
    global $link;
    $link = mysqli_connect('localhost', 'root', 'root', 'ktteam');
    if ($dataoftask['id'] > 0) {

        $sql = 'UPDATE tasklist SET Text="' . $dataoftask['Text'] . '", IdUser="' . $dataoftask['IdUser'] . '", 
        Status="' . $dataoftask['Status'] . '",Created="' . $dataoftask['Created'] . '" WHERE id=' . $dataoftask['id'];
        //  echo $sql;
        if (mysqli_query($link, $sql)) {
            $answ = 1;
        } else {
            $answ = 2;
        }
    } else {
        $sql = 'INSERT INTO tasklist (Text,IdUser,Status,Created) VALUES
   ("' . $dataoftask['Text'] . '",
    "' . $dataoftask['IdUser'] . '",
    "' . $dataoftask['Status'] . '",
    "' . $dataoftask['Created'] . '")';
        if (mysqli_query($link, $sql)) {
            $answ = 1;
        } else {
            $answ = 2;
        }
    }
    echo $answ;
}

?>