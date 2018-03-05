<?php

$filename = __DIR__ . DIRECTORY_SEPARATOR . "big_csv.csv";

// Открываем csv-файл на чтение
$fileCsv = fopen($filename, "rb");

//----------------------------------
// Файл не открыт - ошибка - выход
if ($fileCsv === false) {
    echo "Ошибка открытия файла<br>\n";
    die;
}
//----------------------------------

// Создаем Json-файл
$fileJson = fopen(str_replace('.csv', '.json', $filename), "wb");

// В первой строке csv содержит названия полей
$s = stream_get_line($fileCsv, 4096, "\n");
$fieldNames = explode(',', $s);

// размер входного файла в байтах (будем использовать для отображения прогресса)
$fileSize = filesize($filename);
$curPos = 0; // текущая позиция в файле
$progress = [
    '0 %' => false,
    '10 %' => false,
    '20 %' => false,
    '30 %' => false,
    '40 %' => false,
    '50 %' => false,
    '60 %' => false,
    '70 %' => false,
    '80 %' => false,
    '90 %' => false
];
echo "Обработано: <br>\n";
//----------------------------------------------------------
while (!feof($fileCsv)) {
    // Читаем строку из файла
    $s = stream_get_line($fileCsv, 4096, "\n");
    $curPos += strlen($s);

    // Преобразуем в массив
    $dataArr = explode(',', $s);

    // Создаем ассоциативный массив
    $structArr = [];
    for ($i = 0; $i < count($fieldNames); $i++) {
        $structArr[$fieldNames[$i]] = $dataArr[$i];
    }

    // Кодируем ассоциативный массив в json
    $json = json_encode($structArr, JSON_UNESCAPED_UNICODE);

    // Пишем json-строку в файл
    fwrite($fileJson, $json . "\n");

    // Отображаем процент выполнения
    $percent = (int)(($curPos * 100) / $fileSize);
    if ($percent % 10 == 0) {
        if (!$progress["$percent %"]) {
            echo "$percent % <br>\n";
            flush(); // чтобы echo не зависало :)
            $progress["$percent %"] = true;
        }
    };
}
//----------------------------------------------------------
echo "100 % <br>\n";
echo "Обработка завершена<br>\n";

fclose($fileCsv);
fclose($fileJson);
