<?php

//Определяем контроллер по get параметру
$controllerName = isset($_GET["controller"]) ? ucfirst($_GET["controller"]) : "Index";
//Определяем метод по get параметру
$actionName = isset($_GET["action"]) ? $_GET["action"] : "index";

echo "Controller: ". $controllerName , "<br />Action: ". $actionName;