<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//############################################################
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

//############################################################
