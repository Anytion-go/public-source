<?php
$DeleteFile = function ($path) {
    $target = $_GET['target'] ?? "";
    if (is_dir('.' . $path . $target)) {
        rmdir('.' . $path . $target);
    } else {
        unlink('.' . $path . $target);
    }
    $default_path = getPath();
    header("Location: $default_path");
    die;
};

$export = $DeleteFile;