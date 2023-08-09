<?php
$Navbar =function () {
    return <<<HTML
    <nav>
        <a href="/">home</a>
        <a href="/about">about</a>
        <a href="/source/">source</a>
    </nav>
    HTML;
};

$export = $Navbar;