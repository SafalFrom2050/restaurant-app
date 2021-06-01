<?php

spl_autoload_register(function ($className)
{
    $ext = ".php";

    $fullPath = CLASSES_PATH.$className.$ext;
    $fullPath = str_replace('\\','/',$fullPath);

    if (!file_exists($fullPath)) {
        return false;
    }

    require_once $fullPath;
});