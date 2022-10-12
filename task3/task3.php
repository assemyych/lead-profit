<?php
include 'File.php';

try {
    $dataFile = new File('datafiles');
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}

foreach ($dataFile->getFiles() as $fileName) {
    echo $fileName . "\n";
}