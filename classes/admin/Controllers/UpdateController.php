<?php

namespace admin\Controllers;


use Models\Update;
use admin\Services\UpdateService;

class UpdateController {

    public $request;
    public $update;
    public $view;


    public function __construct($request)
    {
        $this->request = $request;
        $this->handleRequest();
    }

    public function index()
    {
        return loadTemplate($this->view, ['update' => $this->update ]);
    }

    public function viewUpdates()
    {
        $props = [
            'updates' => Update::create(getPDO())->findAll(),
        ];

        $this->view = TEMPLATES_PATH . 'updates-template.php';

        return loadTemplate($this->view, $props);
    }

    public function manageUpdates()
    {
        $props = [
            'updates' => Update::create(getPDO())->findAll(),
        ];

        $this->view = TEMPLATES_PATH_ADMIN . 'updates-template.php';

        return loadTemplate($this->view, $props);
    }

    private function handleRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            UpdateService::create(getPDO())->performAction($this->request);
        }
        if (isset($_GET['id'])) {
            $this->update = Update::create(getPDO())->find($_GET['id']);
        }

        $this->view = TEMPLATES_PATH_ADMIN . 'add-update-template.php';

    }
}

