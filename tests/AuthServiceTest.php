<?php

require_once 'classes/Database/DatabaseModel.php';
require_once 'classes/Database/DatabaseTable.php';
require_once 'classes/Models/Member.php';
require_once 'classes/admin/Services/AuthService.php';
require_once 'functions/helper.php';

use admin\Services\AuthService;
use Models\Member;
use PHPUnit\Framework\TestCase;

class AuthServiceTest extends TestCase
{
    private $testRequest = [
        'full_name' => 'test test',
        'username' => 'test',
        'password' => 'password',
        'is_admin' => 0,
    ];

    public function testValidUserLogin()
    {
        $memberId = Member::with(getPDO(), $this->testRequest)->save();

        $authService = AuthService::create(getPDO());

        self::assertTrue($authService->loginUser($this->testRequest));

        Member::create(getPDO())->delete($memberId);
    }

    public function testInvalidUserLogin()
    {

        $authService = AuthService::create(getPDO());

        self::assertFalse($authService->loginUser($this->testRequest));
    }
}
