<?php

namespace admin\Controllers;


use admin\Services\MemberService;
use Models\Member;

class MemberController {
    public $request;
    public $view;
    public $layoutStyle;

    public $props = [
        'members' => [],
    ];

    public function __construct($request)
    {
        $this->request = $request;
        $this->handleRequest();
    }

    public function index()
    {
        return $this->view;
    }

    public function handleRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            MemberService::create(getPDO())->performAction($this->request);
        }

        $this->props['members'] = Member::create(getPDO())->findAll();
        $this->view = loadTemplate(TEMPLATES_PATH_ADMIN . 'members-template.php', $this->props);
    }
}