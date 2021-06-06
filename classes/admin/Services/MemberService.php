<?php

namespace admin\Services;


use Models\Member;

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

            $member = Member::with(getPDO(), $request);
            $member->save();
        }

        /** Operations on existing rows */

        if (!isset($request['id'])) {
            return;
        }

        if ($method === 'delete') {
            $member = Member::create($this->pdo);
            $member->delete($request['id']);
        }else if ($method === 'put') {
            $member = Member::with(getPDO(), $request);
            $member->update();
        }else if ($method === 'patch') {
            // TODO: patch logic
        }
    }
}