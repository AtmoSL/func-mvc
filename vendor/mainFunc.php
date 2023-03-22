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


/**
 * Метод генерации view
 *
 * @param string $view
 * @param array $params
 * @return void
 */
function render($view, $params = []){
    extract($params);
    require_once "../views/".$view.".php";
}