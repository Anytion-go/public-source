<?php
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

$export = $UploadFile;