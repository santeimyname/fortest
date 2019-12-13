<?php

require 'app/header.php';
require 'app/footer.php';
require_once 'app/include/functions.php';
$users = get_users();
?>
<script src="/scripts/script.js"></script>
<div class="col-md-9">
    <button type="button" class="btn btn-outline-secondary" onclick="javascript:document.location.href='/useredit.php'"">Создать</button>
    <button type="button" class="btn btn-outline-secondary" onclick="DoRemoveUser();">Удалить</button>


<table class="table">
    <thead class="thead-default">
    <tr>
      <th>#</th>
      <th>ИД</th>
      <th>Имя</th>
      <th>Фамилия</th>
      <th>Отдел</th>
      <th>Должность</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($users as $user) :?>
    <?php $lnk="/useredit.php?id=".$user["id"];?>
    <tr>
      <?php  echo "<td><input type='checkbox' name='checkbox' value='". $user["id"] . "' </td>"; ?>
      <td> <a href=<?php echo $lnk; ?>><?php echo $user["id"] ?></td>
      <td> <a href=<?php echo $lnk; ?>><?php echo $user["Iname"] ?></td>
      <td> <a href=<?php echo $lnk; ?>><?php echo $user["Fname"] ?></td>
      <td> <a href=<?php echo $lnk; ?>><?php echo $user["Department"] ?></td>
      <td> <a href=<?php echo $lnk; ?>><?php echo $user["Post"] ?></td>
    </tr>
    <? endforeach;?>
  </tbody>
</table>
</div>

