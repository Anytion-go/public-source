<?php
$title = import('nexit/title');

$Home = function () use ($title) {
  $title('Nexit app'); // use title function to change title
  return <<<HTML
    <div>
      <h1>sorce files</h1>
      <dir>
        this is website to keep and publish files maybe from any open source project. 
      </dir>
      <dir>
        <a href="/source/">go to source</a>
      </dir>
    </div>
    HTML;
};

$export = $Home;
