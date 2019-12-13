<?php
require 'app/header.php';
require 'app/footer.php';
require_once 'app/include/functions.php';


$dataoftask = [];
$dataoftask['ftask'] = '';
$dataoftask['fuser'] = '';
$dataoftask['fdatefrom'] = '';
$dataoftask['fdateto'] = '';

if (isset($_POST['fliststatus'])) {
    $dataoftask['fliststatus'] = $_POST['fliststatus'];
}
if (isset($_POST['ftask'])) {
    $dataoftask['ftask'] = $_POST['ftask'];
}
if (isset($_POST['fuser'])) {
    $dataoftask['fuser'] = $_POST['fuser'];
}
if (isset($_POST['fdatefrom'])) {
    $dataoftask['fdatefrom'] = $_POST['fdatefrom'];
}
if (isset($_POST['fdateto'])) {
    $dataoftask['fdateto'] = $_POST['fdateto'];
}
$tasks = get_tasklist($dataoftask);
?>
<script src="/scripts/script.js"></script>
<div class="col-md-9">
    <button type="button" class="btn btn-outline-secondary" onclick="javascript:document.location.href='/taskedit.php'">
        Создать
    </button>
    <button type="button" class="btn btn-outline-secondary" onclick="DoRemoveTask();">Удалить</button>


    <form name="filter" action="tasks.php" method="post" id="filter">
        <table id="filter">
            <tr>
                <td style="padding-left: 4px; "><label>Задача:</label>
                    <input type="text" name="ftask" style="width: 140px; height: 18px" id="ftask" value="<?php echo $dataoftask['ftask'] ?>"> </input>
                </td>
                <td style="padding-left: 4px;">
                    <label>Назначена:</label>
                    <input type="text" name="fuser" id="fuser" style="width: 140px;  height: 18px" value="<?php echo $dataoftask['fuser'] ?>"> </input>
                </td>
                <td style="padding-left: 4px; ">
                    <label>Статус:</label>
                    <?php
                    echo '<select name="fliststatus" style="width: 140px; " id="fliststatus">';
                    $list = get_status_list();
                    echo '<option value=-1> Все </option>';
                    if (!is_array($list)) {
                    } else
                        foreach ($list as $item) {
                            $selected = ($dataoftask['fliststatus'] == $item['id']) ? ' selected="selected"' : '';
                            echo '<option value=' . $item['id'] . $selected . '>' . $item['Text'] . '</option>';
                        }
                    echo '</select>';
                    ?>
                </td>
                <td style="padding-left: 4px; width: 340px;">
                    <label>Создана от:</label></br>
                    <input type="date" id="fdatefrom" name="fdatefrom"
                           min="2019-10-01" max="2019-12-31" style="width: 135px;  height: 18px"
                           value="<?php echo $dataoftask['fdatefrom'] ?>">
                    <label>до</label>
                    <input type="date" id="fdateto" name="fdateto"
                           min="2019-10-01" max="2019-12-31" style="width: 135px;  height: 18px"
                           value="<?php echo $dataoftask['fdateto']?>">
                </td>
                <td style="padding-left: 4px; width: 150px;">
                    <button type="submit" class="btn btn-outline-secondary">Найти</button>
                    <button type="button" class="btn btn-outline-secondary" onclick="DoResetTask()">Сброс</button>
                </td>
            </tr>
        </table>
    </form>
    <table class="table" id="example">
        <thead class="thead-default">
        <tr>
            <th>#</th>
            <th>ИД</th>
            <th>Текст задачи</th>
            <th>Назначена</th>
            <th>Статус</th>
            <th>Создана</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tasks as $task) : ?>
            <?php $lnk = "/taskedit.php?id=" . $task["Id"];
            $status = get_status($task["Status"]);
            ?>
            <tr>
                <?php echo "<td><input type='checkbox' name='checkbox' value='" . $task["Id"] . "' </td>"; ?>
                <td><a href=<?php echo $lnk; ?>><?php echo $task["Id"] ?></td>
                <td><a href=<?php echo $lnk; ?>><?php echo $task["Text"] ?></td>
                <td><a href=<?php echo $lnk; ?>><?php echo get_user_name($task["IdUser"]); ?></td>
                <td><a href=<?php echo $lnk; ?>><?php echo $status[0]["Text"]; ?></td>
                <td><a href=<?php echo $lnk; ?>><?php echo $task["Created"]; ?></td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>
</div>
