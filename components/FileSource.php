<?php
$export = function ($req, $res) {
    $path = getPath();
    $path = '.' . $path;
    if (!file_exists($path)) {
        $res->status(404);
        $res->send('404 not found');
        die;    
    }
    header("Content-Type:" . mime_content_type($path));
    echo file_get_contents($path);
    // $res->send($path);
};
