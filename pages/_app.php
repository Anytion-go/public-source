<?php
session_start();
import('wisit-router');
import('dotenv')->config();
$useApi = import('nexit/useApi');
$Navbar = import('./components/Navbar');

$export = function ($Component) use ($useApi, $Navbar) {
  $params_0 = getParams(0);
  $params_last = getParams();

  $GLOBALS['title'] = 'title';
  $styles = showStyles();
  $content = $Component();

  if ($params_0 == 'admin') {
    if (!isset($_SESSION['admin'])) {
      $Component = import('./pages/_error');
    } else {
      if ($params_last == '') {
        $content = import('./components/admin/AdminMainSource')();
      } else {
      }
    }
  }
  $useApi('api', $Component);

  if ($params_0 == 'source') {
    if ($params_last != '') {
      $FileSource = import('./components/FileSource');
      $useApi('*', $FileSource);
      die;
    } else {
      $content = import('./components/MainSource')();
    }
  }


  return <<<HTML
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" href="/public/logo.png" type="image/svg" sizes="16x16">
      <title>{$GLOBALS['title']}</title>
      {$styles} 
      <link rel="stylesheet" href="/styles/style.css">
    </head>
    <body>
      {$Navbar()}
      {$content}
    <script src="/styles/script.js"></script>
    </body>
    </html>
    HTML;
};
