<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$link = mysqli_connect('localhost', 'root', 'root', 'ktteam');

if (mysqli_connect_errno())
{
    echo 'Ошибка подключения к базе данных'.mysqli_connect_error();
    exit;
}


