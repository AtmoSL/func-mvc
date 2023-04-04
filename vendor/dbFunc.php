<?php
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
 * Преобразование результата SQL в массив (для 1 строчки)
 *
 * @param $sql
 * @return array
 */
function mysqliQueryOneArray($sql)
{

    $row = mysqli_query(DB_CONNECT, $sql);

    $result = mysqli_fetch_assoc($row);

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
    $id = mysqli_insert_id(DB_CONNECT);

    return $id;
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