<?php

require 'app/header.php';
require 'app/footer.php';
require_once 'app/include/functions.php';

if (isset($_GET['id']) && ($_GET['id'] >0))
{
   $id=$_GET['id'];
}

if(isset($id))
{
    $myrow=get_user($id);
    $user=$myrow[0];
    $Name = $user["Iname"];
    $Fam = $user["Fname"];
    $Dep = $user["Department"];
    $Post = $user["Post"];
}
else {
    $Name = '';
    $Fam = '';
    $Dep = '';
    $Post = '';
}
?>
<script src="/scripts/script.js"></script>
<div class="col-md-9">
    <button type="button" class="btn btn-outline-secondary" onclick="DoSave();">Сохранить</button>
    <button type="button" class="btn btn-outline-secondary" onclick="DoRemove();">Удалить</button>
    <form action="action_page.php" method="post">
        <p>
            <label>Имя:</label><br />
            <input type="text" name="CustName" id="CustName" size="80" value="<?php echo $Name ?>"> </input>
        </p>
        <p>
            <label>Фамилия:</label><br />
            <input type="text" name="CustFam" id="CustFam" size="80" value="<?php echo $Fam ?>"> </input>
        </p>
        <p>
            <label>Отдел:</label><br />
            <input type = "text" name="CustDep" id="CustDep" size="80" value="<?php echo $Dep ?>"> </input>
        </p>
        <p>
            <label>Должность:</label><br />
            <input type = "text" name="CustPost" id="CustPost" size="80" value="<?php echo $Post ?>"> </input>
        </p>
        <input type = "hidden" name="id" id="id" value="<?php echo $id ?>"> </input>
    </form>
</div>

