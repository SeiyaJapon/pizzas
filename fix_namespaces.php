<?php

$directory = __DIR__ . '/src/SharedContext';
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($directory),
    RecursiveIteratorIterator::SELF_FIRST
);

foreach ($files as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        $content = str_replace(
            'namespace App\ShareContext',
            'namespace App\SharedContext',
            $content
        );
        file_put_contents($file->getPathname(), $content);
        echo "Fixed namespace in: " . $file->getPathname() . "\n";
    }
} 