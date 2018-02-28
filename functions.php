<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//##############################################################################
// Задание #1

function task1($strArr, $concat = false)
{
    // Проверка корректности входных параметров
    //----------------------------------------------
    if (!is_array($strArr)) {
        return NULL; // или exception?
    }
    $isString = true;
    foreach ($strArr as $s) {
        if (gettype($s) <> 'string') {
            $isString = false;
            break;
        }
    }
    if (!$isString) {
        return NULL; // или exception?
    }
    //----------------------------------------------
    // Попали сюда - значит входные параметры корректные
    foreach ($strArr as $s) {
        echo "<p>" . $s . "</p>\n";
    }
    if ($concat) {
        return implode(' ', $strArr);
    }
}

//##############################################################################
// Задание #2

function task2($numArr, $operation)
{
    define(
        'ERR_MSG_WRONG_FIRST_PARAM',
        'Первый параметр функции <b>task2</b> должен быть массивом чисел'
    );
    define(
        'ERR_MSG_WRONG_SECOND_PARAM',
        'Второй параметр функции <b>task2</b> должен быть строкой,<br>' .
        'содержащей один символ: "+", "-", "*" или "/"'
    );

    // Проверка корректности входных параметров
    //--------------------------------------------------------------------
    // Тестируем первый входной параметр

    // TODO: Массив должен быть не ассоциативным

    if (!is_array($numArr)) {
        echo ERR_MSG_WRONG_FIRST_PARAM;
        return NULL; // или exception?
    }
    $isNum = true;
    foreach ($numArr as $n) {
        if (!is_numeric($n)) {
            $isNum = false;
            break;
        }
    }
    if (!$isNum) {
        echo ERR_MSG_WRONG_FIRST_PARAM;
        return NULL; // или exception?
    }
    //--------------------------------------------------------------------
    // Тестируем второй входной параметр
    // Инициализируем флаги для тестирования $operation
    $operationTest1 = $operationTest2 = $operationTest3 = false;

    // Тест 1: операция должна быть строкой
    $operationTest1 = is_string($operation);

    if ($operationTest1) { // Тест 1 прошли успешно
        // Тест 2: длина строки должна быть 1 символ
        $operation = trim($operation); // отбрасываем пробелы
        $operationTest2 = (strlen($operation) == 1);

        if ($operationTest2) { // Тест 2 прошли успешно
            // Тест 3: операция должна быть + - * или /
            $operationTest3 = (strpos('+-*/', $operation) !== false);
        }
    }
    // Все три теста должны быть == true
    // Если хотя бы один тест == false, то выходим из функции
    if ((!$operationTest1) || (!$operationTest2) || (!$operationTest3)) {
        echo ERR_MSG_WRONG_SECOND_PARAM;
        return NULL; // или exception?
    }
    //--------------------------------------------------------------------
    // Попали сюда - значит входные параметры корректные

    switch ($operation) {
        case '+':

            break;
        case '-':

            break;
        case '*':

            break;
        case '/':

            break;
    }


    // Выводим результат на экран
    // echo $result;
}

//##############################################################################



