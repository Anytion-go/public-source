<?php
return function ($path = 'api', $component, $props = '') {
    $getPath = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $params = explode('/', substr($getPath, 1));
    if ($path == '*' || isset($params[0]) && $path == $params[0]) {
        $request  = require('./modules/nexit/request.php');
        $response  = require('./modules/nexit/response.php');

        echo $component($request, $response, $props);
        die;
    }
};
