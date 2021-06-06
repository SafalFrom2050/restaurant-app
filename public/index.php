
<?php

use Controllers\AppController;
use Models\Member;
use Models\Review;

define('ROOT_PATH', dirname($_SERVER['DOCUMENT_ROOT']).'/');

const VIEWS_PATH = ROOT_PATH . 'views/';
const COMPONENTS_PATH = ROOT_PATH . 'views/components/';
const LAYOUTS_PATH = ROOT_PATH . 'views/layouts/';
const TEMPLATES_PATH = ROOT_PATH . 'views/templates/';

const COMPONENTS_PATH_ADMIN = ROOT_PATH . 'views/admin/components/';
const LAYOUTS_PATH_ADMIN = ROOT_PATH . 'views/admin/layouts/';
const TEMPLATES_PATH_ADMIN = ROOT_PATH . 'views/admin/templates/';

const ROUTES_PATH = ROOT_PATH . 'routes/';
const ROUTES_PATH_ADMIN = ROOT_PATH . 'routes/admin/';

const CLASSES_PATH = ROOT_PATH . 'classes/';
const CONTROLLERS_PATH = ROOT_PATH . 'classes/Controllers/';
const MODELS_PATH = ROOT_PATH . 'classes/Models/';

const CONTROLLERS_PATH_ADMIN = ROOT_PATH . 'classes/admin/Controllers/';
const MODELS_PATH_ADMIN = ROOT_PATH . 'classes/admin/Models/';

require ROOT_PATH.'functions/helper.php';
require_once ROOT_PATH.'includes/autoloader.inc.php';

$controller = new AppController($_GET);

echo $controller->index();




