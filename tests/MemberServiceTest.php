<?php

require_once 'classes/Database/DatabaseModel.php';
require_once 'classes/Database/DatabaseTable.php';
require_once 'classes/Validators/Validator.php';
require_once 'classes/Validators/MemberValidator.php';
require_once 'classes/Models/Member.php';
require_once 'classes/admin/Services/MemberService.php';
require_once 'functions/helper.php';

use admin\Services\MemberService;
use Models\Member;
use PHPUnit\Framework\TestCase;

class MemberServiceTest extends TestCase
{

    private $testRequest = [
        'username' => 'testtesttest',
        'password' => 'test password',
        'is_admin' => 0,
        'full_name' => 'Test Name',
    ];

    private $id;
    
    public function testCreateMember()
    {
        $memberService = new MemberService(getPDO());
        $this->id = $memberService->createMember($this->testRequest);

        self::assertNotNull( Member::create(getPDO())->find($this->id)->id, "Member not created!");

        Member::create(getPDO())->delete($this->id);

        $this->testRequest['id'] = $this->id;
        $memberService->deleteMember($this->testRequest);
    }

    public function testUpdateMember()
    {
        $memberService = new MemberService(getPDO());
        $this->id = $memberService->createMember($this->testRequest);

        $this->testRequest['is_admin'] = 0;
        $this->testRequest['id'] = $this->id;

        $memberService->updateMember($this->testRequest);
        self::assertEquals(0, Member::create(getPDO())->find($this->id)->isAdmin, "Member not created!");

        Member::create(getPDO())->delete($this->id);

        $this->testRequest['id'] = $this->id;
        $memberService->deleteMember($this->testRequest);
    }

    public function testDeleteMember()
    {
        $memberService = new MemberService(getPDO());
        $this->id = $memberService->createMember($this->testRequest);

        Member::create(getPDO())->delete($this->id);

        $this->testRequest['id'] = $this->id;
        $memberService->deleteMember($this->testRequest);

        self::assertFalse( isset(Member::create(getPDO())->find($this->id)->id), "Member not created!");
    }
}
