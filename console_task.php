<?php

/*
https://stackoverflow.com/questions/24783862/list-all-the-files-and-folders-in-a-directory-with-php-recursive-function
*/

$shortopts = 'p:';
$longopts = ['path:'];

// Входные параметры
$options = getopt($shortopts, $longopts);

// Проверка на валидность
if (!is_dir($options['path'])) {
    echo 'Ошибка: в параметре path должен быть указан путь к папке';
    die;
}
//------------------------------------------------------------------
// Попали сюда - значит входной параметр валидный

$FilesIterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($options['path']));

$files = [];
foreach ($FilesIterator as $file) {
    if ($file->isDir()) {
        continue;
    }
    $files[] = $file->getPathname();
}

natcasesort($files); // Сортируем массив в "натуральном" порядке
$files = array_values($files); // обновляем ключи с нуля (0,1,2,...)

$outputCsvFilename = __DIR__ . DIRECTORY_SEPARATOR . "files_list.csv";
$outputCsvFile = fopen($outputCsvFilename, 'wb');

for ($i = 0; $i < count($files); $i++) {
    $csvFields = [];
    $csvFields[0] = $files[$i];
    $csvFields[1] = filesize($files[$i]);
    $csvFields[2] = date("Y-m-d H:i:s", filemtime($files[$i]));

    fputcsv($outputCsvFile, $csvFields, ',');
}

fclose($outputCsvFile);

echo 'CSV файл создан';
