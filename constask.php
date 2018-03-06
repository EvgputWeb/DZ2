<?php

function saveDirInfoToFile($path, $outputCsvFilename)
{
    $outputCsvFile = fopen($outputCsvFilename, 'wb');

    $FilesIterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));

    foreach ($FilesIterator as $file) {
        if ($file->isDir()) {
            continue;
        }
        $fileName = $file->getPathname();

        $csvFields = [];
        $csvFields[0] = $fileName;
        $csvFields[1] = filesize($fileName);
        $csvFields[2] = date("Y-m-d H:i:s", filemtime($fileName));

        fputcsv($outputCsvFile, $csvFields, ',');
    }

    fclose($outputCsvFile);
}


function getArg()
{
    $shortopts = 'p:';
    $longopts = ['path:'];

    // Входные параметры
    $options = getopt($shortopts, $longopts);

    // Проверка на валидность
    if (!is_dir($options['path'])) {
        return false;
    }

    return $options['path'];
}


//------------------------------------------------------------------
// Основная программа:

$inputPath = getArg();
if ($inputPath === false) {
    echo 'Ошибка: в параметре path должен быть указан путь к папке';
    die;
}

$outputCsvFilename = __DIR__ . DIRECTORY_SEPARATOR . "files_list.csv";

saveDirInfoToFile($inputPath, $outputCsvFilename);

echo 'CSV файл создан: "' . $outputCsvFilename . '"';
//------------------------------------------------------------------
