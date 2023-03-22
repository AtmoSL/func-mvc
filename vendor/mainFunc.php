<?php


/**
 * Загрузка страницы
 *
 * @param String $controllerName
 * @param String $actionName
 */
function load($controllerName, $actionName){
    //Подключаем контроллер
    include_once ControllersPrefix . $controllerName . ControllersPostfix;
    //Определяем метод
    $action = $actionName."Action";

    //Вызываем метод
    $action();

}