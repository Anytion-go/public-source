<?php
/*  * Copyright (c) 2022 ณวสันต์ วิศิษฏ์ศิงขร
    *
    * This source code is licensed under the MIT license found in the
    * LICENSE file in the root directory of this source tree.
*/
function import($dir, $fileDir = false)
{
    try {
        if ($fileDir) {
            $dir = $dir . '/' . $fileDir;
            if (strpos($dir, '.css')) {
                if (!in_array($dir, $GLOBALS['style'])) {
                    array_push($GLOBALS['style'], $dir);
                }
            } elseif (strpos($dir, '.php') !== false) {
                $comp = (function () use ($dir) {
                    require($dir);
                    if ($export ?? false) return $export;
                })();
                return $comp;
            }
        } else {
            if (strpos($dir, '.css')) {
                if (!in_array($dir, $GLOBALS['style'])) {
                    array_push($GLOBALS['style'], $dir);
                }
            } elseif (strpos($dir, './') !== false) {
                $comp = (function () use ($dir) {
                    require($dir . '.php');
                    if ($export ?? false) return $export;
                })();
                return $comp;
            } elseif (strpos($dir, '/') !== false) {
                return require('./modules/' . $dir . '.php');
            } else {
                return require('./modules/' . $dir . '/main.m.php');
            }
        }
    } catch (Error $err) {
        $message = 'can not import from ( \'' . $dir . '\' ) |  Please check your directory';
        echo 'ERROR ! import : ' . $message;
        $err = explode('#', $err);
        echo '<br>';
        echo $err = $err[sizeof($err) - 2];
        echo '<br>';
        $state = false;
        $error = '';
        $str_len = strlen($err);
        for ($i = 0; $i < $str_len; $i++) {
            if ($err[$i] == "'" && !$state) {
                $state = !$state;
            } elseif ($err[$i] == "'" && $state) {
                break;
            } elseif ($state) {
                $error .= $err[$i];
            }
        }
        echo 'Please check at ' . $error . '.php';
    }
}

$GLOBALS['style'] = [];
function showStyles()
{
    if (sizeof($GLOBALS['style']) > 0) {
        $sss = '<style>';
        foreach ($GLOBALS['style'] as $s) {
            $sss .= file_get_contents($s);
        }
        $sss .= '</style>' . PHP_EOL;
        return $sss;
    }
};
