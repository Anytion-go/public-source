<?php
return new class
{ // return obj
    function set($field, $value)
    {
        header("{$field}: {$value}");
    }
    function send($value)
    {
        header('Content-Type: text/html;charset=UTF-8');
        echo $value;
    }
    function status($status)
    {
        http_response_code($status);
    }
    function json($value)
    {
        header('Content-Type: application/json;charset=UTF-8');
        echo json_encode($value);
    }
};
