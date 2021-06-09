<?php
$pdo = new PDO('mysql:dbname=kitchen;host=127.0.0.1', 'student', 'student');

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

function getPDO()
{
    return $GLOBALS['pdo'];
}


function snakeToCamelCase($str)
{
    // replace '_' with ' '(space)
    $str = str_replace('_', ' ', $str);

    // Capitalize 1st letter of each words, then replace ' '(space) with ''(empty string)
    $str = str_replace(' ', '', ucwords($str));

    // Lower case the 1st letter
    return lcfirst($str);
}

function camelToSnakeCase($str)
{
    return strtolower(
        preg_replace(
            ["/([A-Z]+)/", "/_([A-Z]+)([A-Z][a-z])/"],
            ["_$1", "_$1_$2"],
            lcfirst($str)
        )
    );
}

function randomString($length = 8)
{
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

function csrf()
{
    echo '<input type="hidden" name="token" value="' . $_SESSION['token'] . '"/>';
}

function input_id($value)
{
    echo '<input type="hidden" name="id" value="'. $value . '" />';
}

function input_method($verb)
{
    echo '<input type="hidden" name="_method" value="' . $verb . '" />';
}

function input_submit($value)
{
    echo '<input type="submit" name="submit" value="' . $value . '" />';
}

function input_hidden($name, $value)
{
    echo '<input type="hidden" name="' . $name . '" value="' . $value . '" />';
}

function getSanitizedRequestUri(){

    // Removes extra '/' from requested page if any
    $requestUri = trim($_SERVER['REQUEST_URI'], '/');

    $requestUri = explode('/', $requestUri);

    // Also remove GET params (at last array index)
    $requestUri[count($requestUri)-1] = explode('?', $requestUri[count($requestUri)-1])[0];

    return $requestUri;
}