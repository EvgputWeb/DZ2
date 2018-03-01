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


function task2($numArr, $operation)
{
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

    // Количество аргументов должно быть минимум 2
    if (count($args) < 2) {
        echo "<br>Недостаточно входных параметров<br>\n";
        return NULL;
    }

    $operation = $args[0];
    unset($args[0]);
    $values = array_values($args); // переиндексируем массив с нуля

    task2($values, $operation);

}

//##############################################################################
//##############################################################################
// Задание #4

//---------------------------------------------------------------------------
// Рекурсивная функция для вывода таблиц размером от (size x size) до (1 x 1)
function print_mult_table($size)
{

    if ($size < 1) {
        // Выход из рекурсии
        return;

    } else {

        echo "<table class=\"mult-table\">\n";
        for ($i = 1; $i <= $size; $i++) {
            echo "<tr>\n";
            for ($j = 1; $j <= $size; $j++) {
                echo "<td>" . $i * $j . "</td>";
            }
            echo "\n</tr>\n";
        }
        echo "</table>\n";
        echo "<br><br>\n";

        print_mult_table(--$size);

    }
}

//---------------------------------------------------------------------------

function task4($rowCount, $colCount)
{
    if (!is_int($rowCount) || !is_int($colCount)) {
        echo "<br>Входные параметры должны быть целыми числами<br>\n";
        return NULL;
    }
    if ($rowCount <> $colCount) {
        echo "<br>Входные параметры должны быть одинаковыми<br>\n";
        return NULL;
    }

    //--------------------------------------------------------------------
    // Попали сюда - значит входные параметры корректные

    echo "<style>\n";
    echo ".mult-table { border: 2px solid black; border-collapse: collapse; text-align: center;}\n";
    echo ".mult-table td { border: 1px solid black; width: 26px;}\n";
    echo "</style>\n";

    print_mult_table($rowCount);

}


//##############################################################################
//##############################################################################
// Задание #5

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
    if (mb_substr($str, $leftPos, 1) == mb_substr($str, $rightPos, 1)) {
        // Символы одинаковые - продолжаем
        return test_equal_chars($str, ++$leftPos, --$rightPos);
    } else {
        // Встретили разные символы - выходим из функции
        // с результатом false
        return false;
    }
}

//--------------------------------------------------------------------

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

    echo "<br><b>$str</b>";

    // Удаляем пробелы и переводим в нижний регистр
    $str = mb_ereg_replace(' ', '', $str);
    $str = mb_strtolower($str);

    $res = test_equal_chars($str, 0, mb_strlen($str) - 1);

    if ($res) {
        echo " - Палиндром<br>\n";
    } else {
        echo " - Не палиндром<br>\n";
    }

}

//##############################################################################
//##############################################################################
