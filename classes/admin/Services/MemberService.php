<?php

namespace admin\Services;


use Models\Member;
use Validators\MemberValidator;
use Validators\Validator;

class MemberService {
    public $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public static function create($pdo)
    {
        return new MemberService($pdo);
    }

    public function performAction($request)
    {

        // Workaround for unsupported HTTP methods
        if (!isset($request['_method'])) {
            return;
        }
        $method = strtolower($request['_method']);

        // Check for valid csrf token
        if (!isset($request['token']) || $request['token'] !== $_SESSION['token']){
            echo 'Action Failed! (CSRF token missing or incorrect!)';
            return;
        }

        /** Create member */

        if ($method === 'post') {
            $this->createMember($request);
        }

        /** Operations on existing rows */

        if (!isset($request['id'])) {
            return;
        }

        if ($method === 'delete') {
            $this->deleteMember($request);
        }else if ($method === 'put') {
            $this->updateMember($request);
        }
    }

    public function createMember($request)
    {

        if($error = MemberValidator::create($request)->createMemberError()) {
            echo $error;
            return -1;
        }

        $member = Member::with(getPDO(), $request);
        $id = $member->save();

        echo 'New member has been created!';
        return $id;
    }

    public function updateMember($request)
    {

        $member = Member::with(getPDO(), $request);
        $member->update();
        echo 'Member has been updated!';
    }

    public function deleteMember($request)
    {
        $member = Member::create($this->pdo);
        $member->delete($request['id']);
        echo 'Member has been deleted!';
    }
}