<?php
$title = import('nexit/title');

$DeleteFile = function ($path) {
    $target = $_GET['target'] ?? "";
    if (is_dir('.' . $path . $target)) {
        rmdir('.' . $path . $target);
    } else {
        unlink('.' . $path . $target);
    }
    $default_path = getPath();
    header("Location: $default_path");
    die;
};

$UploadFile = function ($path) {
    if (isset($_POST['upload'])) {
        echo  $file_count = count($_FILES['file']['name']);
        for ($i = 0; $i < $file_count; $i++) {
            $_FILES['file']['name'][$i];
            move_uploaded_file($_FILES['file']['tmp_name'][$i], '.' . $path . $_FILES['file']['name'][$i]);
            // print_r('<pre>' . json_encode($_FILES['file']['name'][$i], JSON_PRETTY_PRINT) . '</pre>');
        }
        header("Refresh:0");
        die;
    }
    return <<<HTML
    <div>
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="file[]" id="" multiple required>
            <button name="upload">upload</button>
        </form>
    </div>
    HTML;
};

$AdminMainSource = function () use ($title, $DeleteFile, $UploadFile) {
    $path = getPath();
    $path = explode('/', $path);
    $path[1] = 'source';
    $path = implode("/", $path);

    while (strpos($path, '..') !== false) {
        $path = str_replace('..', '.', $path);
        $path = str_replace('/./', '/', $path);
    }

    // $file_list = glob('.' . $path . '*');
    if (is_dir('.' . $path))
        $file_list = scandir('.' . $path);
    else {
        header('Location: ../');
        die;
    }

    if (isset($_GET['delete'])) $DeleteFile($path);

    $content = <<<HTML
    <tr>
        <td>
            <a class="link-list" href="..">..</a>
        </td>
    </tr>
    HTML;
    $limit = sizeof($file_list);
    for ($i = $limit - 1; $i; $i--) {
        if ($file_list[$i][0] === '.') continue;
        $file_name = is_dir('.' . $path . $file_list[$i]) ?  $file_list[$i] . '/' : $file_list[$i];
        $file_size = filesize('.' . $path . $file_list[$i]);
        if ($file_size >= 1000000) {
            $file_size = number_format($file_size * (10 ** -6), 2) . 'MB';
        } elseif ($file_size >= 1000) {
            $file_size = number_format($file_size * (10 ** -3), 2) . 'KB';
        } else {
            $file_size .= "B";
        }
        $file_type = is_dir('.' . $path . $file_list[$i]) ? "directory" : "file";
        if ($file_type == 'directory') {
            $file_list[$i] .= '/';
        }

        $file_access = fileatime('.' . $path . $file_list[$i]);
        $file_access = date("H:m__Y-M-d", $file_access);
        $content .= <<<HTML
        <tr>
            <td>
                <a onclick="return confirm(`{$file_name}\nAre you sure to delete !?`)" href="?delete=true&target={$file_name}">
                    <button style="border: 2px solid red;">delete</button>
                </a>
            </td>
 
            <td>
                <a class="link-list" href="{$file_list[$i]}">{$file_name}</a>
            </td>
            <td>
                <span>{$file_size}</span>
            </td>
           <td>
                <span>{$file_access}</span>
            </td>
            <td>
                <span>{$file_type}</span>
            </td>   

        </tr>
        HTML;
    }
    $UploadFile_content = $UploadFile($path);
    $title($path);
    return <<<HTML
    <main>
        <hr>
        {$UploadFile_content}
        <hr>
        <div><b>~{$path}</b></div>
        <div style="overflow-x: scroll;">
        <table>
        <thead>
            <th>delete</th>
            <th>file&dir</th>
            <th>size</th>
            <th>create at</th>
            <th>type</th>
        </thead>
        <tbody>
            {$content}
        </tbody>
        </table>
        </div>
    </main>
    HTML;
};

$export = $AdminMainSource;
