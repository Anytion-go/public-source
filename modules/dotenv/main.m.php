<?php
return new class
{
    public function config($directory_env = '.env')
    {
        if (empty($_ENV)) {
            $_ENV = getenv();
        }
        if (file_exists($directory_env)) {

            $sub_env = explode("\n", file_get_contents($directory_env));

            foreach ($sub_env as $value) {
                if (strpos($value, '=') !== false) {
                    [$k, $v] = explode('=', $value);
                    $_ENV[trim($k)] = trim($v);
                }
            }
        } else {
            echo 'PHP Warning:  dotenv config: Failed to open stream: No such file or directory in ' . $directory_env;
        }
    }
};
