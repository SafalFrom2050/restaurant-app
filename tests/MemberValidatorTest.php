<?php

require_once 'classes/Validators/Validator.php';
require_once 'classes/Validators/MemberValidator.php';

use PHPUnit\Framework\TestCase;
use Validators\MemberValidator;

class MemberValidatorTest extends TestCase
{

    private $validRequest = [
        'username' => 'testtesttest',
        'password' => 'test password',
        'is_admin' => 0,
        'full_name' => 'Test Name',
    ];

    private $invalidRequest = [
        'username' => '',
        'password' => 'test password',
        'is_admin' => 0,
        'full_name' => 'Test Name',
    ];

    private $invalidRequest2 = [
        'username' => 'testtest',
        'password' => '',
        'is_admin' => 0,
        'full_name' => 'Test Name',
    ];

    private $invalidRequest3 = [
        'username' => 'testtest',
        'password' => 'password',
        'is_admin' => 0,
        'full_name' => '',
    ];

    public function testCheckInvalidMembers()
    {
       self::assertNotFalse(MemberValidator::create($this->invalidRequest)->createMemberError());
       self::assertNotFalse(MemberValidator::create($this->invalidRequest2)->createMemberError());
       self::assertNotFalse(MemberValidator::create($this->invalidRequest3)->createMemberError());
    }

    public function testCheckValidMember()
    {
        self::assertNotFalse(! MemberValidator::create($this->validRequest)->createMemberError());
    }

}
