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

/**
 * Преобразование результата SQL в массив
 *
 * @param $sql
 * @return array
 */
function mysqliQueryArray($sql){

    $row = mysqli_query(DB_CONNECT, $sql);

    $result = [];

    while($rw = $row->fetch_assoc()){
        $result[] = $rw;
    }
    return $result;
}

/**
 *
 * Функция дебага
 *
 * @param $value
 * @param $die
 */
function debug($value = null, $die = 1){
    print_r($value);
    echo '</pre>';
    if($die) die;
}