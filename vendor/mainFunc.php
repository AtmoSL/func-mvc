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


//TODO Вынести функции для БД в отдельный файл
//TODO Сделать функцию для получения 1 строчки в виде массива
/**
 * Преобразование результата SQL в массив
 *
 * @param $sql
 * @return array
 */
function mysqliQueryArray($sql)
{

    $row = mysqli_query(DB_CONNECT, $sql);

    $result = [];

    while ($rw = $row->fetch_assoc()) {
        $result[] = $rw;
    }
    return $result;
}

/**
 *  Создание строчки в БД
 *
 * @param $sql
 * @return bool
 */
function mysqliCreate($sql)
{
    mysqli_query(DB_CONNECT, $sql);

    return true;
}

function mysqliRowCheck($conditions, $tableName)
{
    $conditionRow = "";
    foreach ($conditions as $key => $condition){
        $conditionRow .= "$key = '$condition'";
    }

    $sql = "SELECT * FROM `$tableName` WHERE $conditionRow";
    $rows = mysqli_query(DB_CONNECT, $sql);

    $rowsArray = mysqli_fetch_array($rows);
    if ($rowsArray) return true;
    return false;
}