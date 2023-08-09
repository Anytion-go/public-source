<?php
/*  * Copyright (c) 2022 ณวสันต์ วิศิษฏ์ศิงขร
    *
    * This source code is licensed under the MIT license found in the
    * LICENSE file in the root directory of this source tree.
*/
require('./modules/use-import/main.m.php');
return function () {
    // func for get path from url
    $getPath = function () {
        return parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    };
    $path = $getPath();
    $path_ex = explode('/', $path);
    $len = sizeof($path_ex);
    $pages = './pages';
    for ($i = 1; $i < $len; $i++) {
        // check is index ?
        if ($path_ex[$i] == '') {
            $pages .= '/index';
        } elseif (file_exists($pages . '/' . $path_ex[$i]) || file_exists($pages . '/' . $path_ex[$i] . '.php')) {
            $pages .= '/' . $path_ex[$i];
        } else {
            $pages .= '/[]';
        }
    }
    if (file_exists($pages . '.php') && strpos($pages, '_') == false) {
        $PageFunc = import($pages);
        // check type of $PageFunc | if it is html code
        if (file_exists('./pages/_app.php')) {
            $_app = import('./pages/_app');
            echo $_app($PageFunc);
            exit;
        } else {
            echo $PageFunc();
            exit;
        }
    } else {
        if (file_exists('./pages/_error.php')) {
            $_error = import('./pages/_error');

            if (file_exists('./pages/_app.php')) {
                $_app = import('./pages/_app');
                echo $_app($_error);
                exit;
            } else {
                echo $_error();
                exit;
            }
        } else {
            echo 'NOT FOUND THIS PAGE !';
            exit;
        }
    }
    // funcFF
};
