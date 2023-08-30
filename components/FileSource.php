<?php
$export = function ($req, $res) {
    $path = getPath();
    $path = urldecode($path);
    $path = '.' . $path;
    while (strpos($path, '..') !== false) {
        $path = str_replace('..', '.', $path);
        $path = str_replace('/./', '/', $path);
    }


    if (!file_exists($path) || !is_file($path)) {
        $res->status(404);
        $res->send('404 not found');
        die;
    }
    $file_type =  mime_content_type($path);
    $file_type = $file_type == 'text/html' ? 'text/plain' : $file_type;

    header("Content-Type:" . $file_type);
    echo file_get_contents($path);
    // $res->send($path);
};
