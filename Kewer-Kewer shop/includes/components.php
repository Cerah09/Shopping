<?php

function component($name, $data = [])
{
    $file = __DIR__ . '/../components/' . $name . '.php';

    if (file_exists($file)) {
        extract($data); // Untuk mengirim data ke komponen
        include $file;
    } else {
        echo "Component '$name' not found.";
    }
}
