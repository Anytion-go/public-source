<?php
$Navbar =function () {
    $admin = isset($_SESSION['admin']) ? '<a href="/admin/">admin</a> <a href="/login?logout">logout</a>': '';

    return <<<HTML
    <nav>
        <a href="/">home</a>
        <a href="/about">about</a>
        <a href="/source/">source</a>
        {$admin}
    </nav>
    HTML;
};

$export = $Navbar;