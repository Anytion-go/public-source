<?php
return new class
{
    function header()
    {
        return apache_request_headers();
    }
    function body()
    { // get value from body
        return file_get_contents('php://input');
    }
    function query()
    { // get value from url
        $url = "$_SERVER[REQUEST_URI]";
        $parts = parse_url($url);
        $output = [];
        parse_str($parts['query'], $output);
        return $output;
    }
    function params($position = -1)
    {
        $path = "$_SERVER[REQUEST_URI]";
        $real_path = '/';
        $str_len = strlen($path);
        for ($i = 1; $i < $str_len; $i++) {
            if ($path[$i] == '?') {
                break;
            } else {
                $real_path .= $path[$i];
            }
        }
        $params = explode('/', substr($real_path, 1));
        if ($position > -1) {
            return str_replace('%20', ' ', $params[$position]);
        } else {
            return str_replace('%20', ' ', $params[sizeof($params) - 1]);
        }
    }
};
