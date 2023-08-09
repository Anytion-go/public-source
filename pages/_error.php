<?php
$useApi = import('nexit/useApi');
$title = import('nexit/title');

$export = function () use ($useApi, $title) {
    // for api 
    $useApi('api', function ($req, $res) {
        $res->json([
            'status' => 404,
            'message' => 'Not Found'
        ]);
    });

    // for normal web pages
    $title('404 Not Found');
    return <<<HTML
    <div>
        <center>
            <h1>Not found this page</h1>
        </center>
    </div>
    HTML;
};
