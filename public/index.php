<?php
session_start();

require_once "../config/config.php"; //Подключения конфига
require_once "../config/db.php"; //Подключение базы данных
require_once "../vendor/dbFunc.php"; //Подключение основных функций для работы с БД
require_once "../vendor/mainFunc.php"; //Подключение основных функций

//Определяем контроллер по get параметру
$controllerName = isset($_GET["controller"]) ? ucfirst($_GET["controller"]) : "Index";
//Определяем метод по get параметру
$actionName = isset($_GET["action"]) ? $_GET["action"] : "index";

load($controllerName, $actionName);