<?php


/**
 * Загрузка страницы
 *
 * @param String $controllerName
 * @param String $actionName
 */
function load($controllerName, $actionName)
{
    if(!file_exists(ControllersPrefix . $controllerName . ControllersPostfix)) header("location: /");
    //Подключаем контроллер
    include_once ControllersPrefix . $controllerName . ControllersPostfix;
    //Определяем метод
    $action = $actionName . "Action";

    //Вызываем метод
    $action();

}

/**
 *
 * Функция дебага
 *
 * @param $value
 * @param $die
 */
function debug($value = null, $die = 1)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    if ($die) die;
}


/**
 * Метод генерации view
 *
 * @param string $view
 * @param array $params
 * @return void
 */
function render($view, $params = [])
{
    extract($params);
    require_once "../views/" . $view . ".php";
}