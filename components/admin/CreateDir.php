<?php
$CreateDir = function ($path) {
    if (isset($_POST['create_dir'])) {
        $true_path = '.' . $path . '/' . $_POST['dir_name'];
        if (!file_exists($true_path)) {
            mkdir($true_path);
            header("Refresh:0");
            die;
        }
    }
    return <<<HTML
    <div>
        <form method="post">
            <label for="create dir">create dir</label>
            <input type="hidden" name="create_dir">
            <input type="text" name="dir_name" placeholder="dir name" id="" required>
            <button>create</button>
        </form>
    </div>
    HTML;
};

$export = $CreateDir;