<?php

function loadTemplate($fileName, $templateVars)
{
    extract($templateVars, EXTR_OVERWRITE);
    ob_start();

    /** Check if file exist.
     * Show 404 error if it doesn't exist.
     */
    if (file_exists($fileName)) {
        require $fileName;
    }else {
        require TEMPLATES_PATH.'404-error-template.php';
    }

    return ob_get_clean();
}

$pdo = new PDO('mysql:dbname=kitchen;host=127.0.0.1', 'student', 'student');
function getPDO() {
    return $GLOBALS['pdo'];
}

