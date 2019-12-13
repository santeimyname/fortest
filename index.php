<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require 'app/header.php';
?>

        <div class="col-md-9">
           <div class="page-header">
               <h1>Менеджер управления задачами</h1>
               <h4>Новых задач: <?php echo count_new_task();?></h4>
               <h4>Задач в работе: <?php echo count_work_task();?></h4>
               <h4>Завершено: <?php echo count_ended_task();?></h4>
               <h4>Приостановлено: <?php echo count_pause_task();?></h4>
           </div>
        </div>


<?php require 'app/footer.php';
?>
