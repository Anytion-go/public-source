<?php
$export = function () {
    if(isset($_GET['logout'])) {
        session_unset();
        header("Location: /login");die;
    }
    if(
        isset($_POST['username']) && 
        isset($_POST['password']) && 
        !empty($_POST['username']) && 
        !empty($_POST['password'])
    ) {
        if($_POST['username'] == $_ENV['USER'] && sha1($_POST['password']) == $_ENV['PASS']) {
            $_SESSION['admin'] = true;
            header("Location: /admin/");
            die;
        }
    }
    return <<<HTML
    <main>
        <form method="POST">
            <div>
                <label for="username">username</label>
                <input type="text" name="username">
            </div>
            <div>
                <label for="password">password</label>
                <input type="password" name="password">
            </div>
            <div>
                <button name="submit">submit</button>
            </div>
        </form>
    </main>
    HTML;
};