<?php
$title = import('nexit/title');
$MainSource = function () use ($title) {
    $path = getPath();

    // $file_list = glob('.' . $path . '*');
    if (is_dir('.' . $path))
        $file_list = scandir('.' . $path);
    else {
        header('Location: ./');
        die;
    }

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
        $file_type = is_dir('.' . $path . $file_list[$i]) ? "directory" : "file";
        $file_access = fileatime('.' . $path . $file_list[$i]);
        $file_access = date("H:m__Y-M-d", $file_access);
        $content .= <<<HTML
        <tr>
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
    $title($path);
    return <<<HTML
    <main>
        <div>~{$path}</div>
        <table>
        <thead>
            <th>file&dir</th>
            <th>size</th>
            <th>create at</th>
            <th>type</th>
        </thead>
        <tbody>
            {$content}
        </tbody>
        </table>
    </main>
    HTML;
};

$export = $MainSource;
