<?php

function scanDirectory($dir) {
    $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

    $files = array(); 

    foreach ($rii as $file) {
        if (!$file->isDir()){ 
            $files[] = $file->getPathname(); 
        }
    }

    return $files;
}

$files = scanDirectory(__DIR__ . '/app');

foreach ($files as $file) {
    $expected = realpath($file);
    $actual = $file;
    
    if ($expected !== $actual) {
        echo "Mismatch: $actual -> $expected\n";
    }
}
