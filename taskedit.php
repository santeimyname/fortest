<?php
require 'app/header.php';
require 'app/footer.php';
require_once 'app/include/functions.php';


if (isset($_GET['id']) && ($_GET['id'] > 0)) {
    $id = $_GET['id'];
}

if (isset($id)) {
    $myrow = get_task($id);
    $task = $myrow[0];
    $Text = $task["Text"];
    $User = $task["IdUser"];
    $Status = $task["Status"];
} else {
    $Text = '';
    $User = '';
    $Status = '';
}
?>
<script src="/scripts/script.js"></script>
<div class="col-md-9">
    <button type="button" class="btn btn-outline-secondary" onclick="DoSaveTask();">Сохранить</button>
    <button type="button" class="btn btn-outline-secondary" onclick="DoRemoveT();">Удалить</button>
    <form action="" method="post">
        <p>
            <label>Задача:</label><br/>
            <input type="text" name="Text" id="Text" size="80" value="<?php echo $Text ?>"> </input>
        </p>
        <p>
            <label>Назначена:</label><br/>
            <?php
            $list = get_users();
            echo '<select name="listuser" id="listuser">';
            echo '<option value=-1> Не назначена </option>';
            foreach ($list as $item) {
                $selected = ($User == $item['id']) ? ' selected="selected"' : '';
                echo '<option value=' . $item["id"] . $selected . '>' . get_user_name($item["id"]) . '</option>';
            }
            echo '</select>' ?>
        </p>
        <p>
            <label>Статус исполнения:</label><br/>
            <?php
            echo '<select name="liststatus" id="liststatus">';
            $list = get_status_list();
            foreach ($list as $item) {
                $selected = ($Status == $item['id']) ? ' selected="selected"' : '';
                echo '<option value=' . $item['id'] . $selected . '>' . $item['Text'] . '</option>';
            }
            echo '</select>';
            ?>
        </p>
        <input type="hidden" name="id" id="id" value="<?php echo $id ?>"> </input>
    </form>
</div>

