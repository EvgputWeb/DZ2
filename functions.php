<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//##############################################################################
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
//##############################################################################
// Задание #2

function task2($numArr, $operation)
{
    define(
        'ERR_MSG_WRONG_FIRST_PARAM',
        "<br>Первый параметр функции <b>task2</b> должен быть массивом чисел<br>\n"
    );
    define(
        'ERR_MSG_WRONG_SECOND_PARAM',
        "<br>Второй параметр функции <b>task2</b> должен быть строкой,<br>\n" .
        "содержащей один символ: '+', '-', '*' или '/'<br>\n"
    );
    define(
        'ERR_MSG_ZERO_DIVISION',
        "<br>Ошибка: деление на ноль<br>\n"
    );

    // Проверка корректности входных параметров
    //--------------------------------------------------------------------
    // Тестируем первый входной параметр
    // Инициализируем флаги для тестирования $numArr
    $arrayTest1 = $arrayTest2 = $arrayTest3 = false;

    // Тест 1: $numArr должен быть массивом (и не пустым)
    $arrayTest1 = is_array($numArr) && (count($numArr) > 0);

    if ($arrayTest1) { // Тест 1 прошли успешно
        // Тест 2: массив должен быть не ассоциативным
        $arrayTest2 = (array_keys($numArr) == range(0, count($numArr) - 1));

        if ($arrayTest2) { // Тест 2 прошли успешно
            // Тест 3: массив должен содержать только числа
            $arrayTest3 = true;
            foreach ($numArr as $n) {
                if (!is_numeric($n)) {
                    $arrayTest3 = false;
                    break;
                }
            }
        }
    }
    // Все три теста должны быть == true
    // Если хотя бы один тест == false, то выходим из функции
    if ((!$arrayTest1) || (!$arrayTest2) || (!$arrayTest3)) {
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
    $result = $numArr[0];

    for ($i = 1; $i < count($numArr); $i++) {
        switch ($operation) {
            case '+':
                $result += $numArr[$i];
                break;
            case '-':
                $result -= $numArr[$i];
                break;
            case '*':
                $result *= $numArr[$i];
                break;
            case '/':
                // Ловим деление на ноль
                $zeroDivider = false;
                ($numArr[$i] == 0) ? ($zeroDivider = true) : ($result /= $numArr[$i]);
                if ($zeroDivider) {
                    echo ERR_MSG_ZERO_DIVISION;
                    return NULL; // или exception?
                }
                break;
        }
    }

    // Выводим результат на экран
    echo "<br>Результат = " . $result . "<br>\n";
}

//##############################################################################
//##############################################################################
// Задание #3

function task3()
{
    $args = func_get_args();

    // Проверка корректности входных параметров
    if (count($args) < 2) {
        echo "<br>Недостаточно входных параметров<br>\n";
        return NULL;
    }
    //--------------------------------------------------------------------
    // Тестируем первый входной параметр
    $operation = $args[0];

    define(
        'ERR_MSG_WRONG_OPERATION',
        "'<br>Первый параметр функции <b>task3</b> должен быть строкой,<br>\n" .
        "содержащей один символ: '+', '-', '*' или '/'<br>\n"
    );

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
        echo ERR_MSG_WRONG_OPERATION;
        return NULL; // или exception?
    }
    //--------------------------------------------------------------------
    // Тестируем остальные входные параметры
    define(
        'ERR_MSG_WRONG_VALUES',
        "<br>Некорректные входные параметры: ожидаются числовые значения<br>\n"
    );

    $goodValues = true;
    for ($i = 1; $i < count($args); $i++) {
        if (!is_numeric($args[$i])) {
            $goodValues = false;
            break;
        }
    }

    if (!$goodValues) {
        echo ERR_MSG_WRONG_VALUES;
        return NULL; // или exception?
    }

    //--------------------------------------------------------------------
    // Попали сюда - значит входные параметры корректные
    $result = $args[1];

    for ($i = 2; $i < count($args); $i++) {
        switch ($operation) {
            case '+':
                $result += $args[$i];
                break;
            case '-':
                $result -= $args[$i];
                break;
            case '*':
                $result *= $args[$i];
                break;
            case '/':
                // Ловим деление на ноль
                $zeroDivider = false;
                ($args[$i] == 0) ? ($zeroDivider = true) : ($result /= $args[$i]);
                if ($zeroDivider) {
                    echo ERR_MSG_ZERO_DIVISION;
                    return NULL; // или exception?
                }
                break;
        }
    }

    return $result;
}

//##############################################################################
//##############################################################################
// Задание #4

function task4($rowCount, $colCount)
{
    if (!is_int($rowCount) || !is_int($colCount)) {
        echo "<br>Входные параметры должны быть целыми числами<br>\n";
        return NULL;
    }
    //--------------------------------------------------------------------
    // Попали сюда - значит входные параметры корректные

    echo "<style>\n";
    echo ".mult-table { border: 2px solid black; border-collapse: collapse; text-align: center;}\n";
    echo ".mult-table td { border: 1px solid black; width: 30px;}\n";
    echo "</style>\n";

    echo "<table class=\"mult-table\">\n";
    for ($i = 1; $i <= $rowCount; $i++) {
        echo "<tr>\n";
        for ($j = 1; $j <= $colCount; $j++) {
            echo "<td>" . $i * $j . "</td>";
        }
        echo "\n</tr>\n";
    }
    echo "</table>\n";
}

//##############################################################################
//##############################################################################
// Задание #5

function task5($str)
{
    if (!is_string($str)) {
        echo "<br>Входной параметр должен быть строкой<br>\n";
        return NULL;
    }

    mb_internal_encoding("UTF-8");
    if (mb_strlen($str) <= 1) {
        echo "<br>В строке должно быть хотя бы 2 символа<br>\n";
        return NULL;
    }
    //--------------------------------------------------------------------
    // Попали сюда - значит входной параметр корректный
    // Удаляем пробелы и переводим в нижний регистр
    $str = mb_ereg_replace(' ', '', $str);
    $str = mb_strtolower($str);

    $reverseStr = '';
    $len = mb_strlen($str);
    for ($i = 0; $i < $len; $i++) {
        $reverseStr .= mb_substr($str, $len - $i - 1, 1);
    }

    //echo "{" . $str . "}<br>\n";
    //echo "{" . $reverseStr . "}<br>\n";

    return ($reverseStr == $str);

}

//##############################################################################

function show_task5_result($str)
{
    $res = task5($str);
    if (!is_null($res)) {
        echo "<b>" . $str . "</b><br>\n";
        if ($res) {
            echo "Данная строка является палиндромом<br><br>\n";
        } else {
            echo "Данная строка НЕ является палиндромом<br><br>\n";
        }
    }
}

//##############################################################################
//##############################################################################
// Рекурсивное решение задания #5

//--------------------------------------------------------------------
// Рекурсивная функция для тестирования совпадения символов
// слева и справа в строке
function test_equal_chars($str, $leftPos, $rightPos)
{
    if ($leftPos >= $rightPos) {
        // Сюда можем попасть только если строка - палиндром
        // т.к. если не палиндром - вывалимся на раннем этапе рекурсии
        return true;
    }
    if ($str[$leftPos] == $str[$rightPos]) {
        // Символы одинаковые - продолжаем
        return test_equal_chars($str, ++$leftPos, --$rightPos);
    } else {
        // Встретили разные символы - выходим из функции
        // с результатом false
        return false;
    }
}
//--------------------------------------------------------------------

function task5r($str)
{
    if (!is_string($str)) {
        echo "<br>Входной параметр должен быть строкой<br>\n";
        return NULL;
    }

    echo "<br><b>$str</b>";

    $res = test_equal_chars($str, 0, strlen($str)-1);

    if ($res) {
        echo " - Палиндром<br>\n";
    } else {
        echo " - Не палиндром<br>\n";
    }

}

//##############################################################################
//##############################################################################
