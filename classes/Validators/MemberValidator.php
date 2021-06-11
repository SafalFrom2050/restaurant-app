<?php


namespace Validators;


class MemberValidator extends Validator
{
    private $request;
    public function __construct($request)
    {
        $this->request = $request;
    }

    public static function create($request)
    {
        return new MemberValidator($request);
    }

    public function createMemberError()
    {
        $request = $this->request;

        if (! Validator::isNotNull($request['username'])) {
            return 'Username is required!';
        }

        if (! Validator::isUniqueUsername($request['username'])) {
            return 'Username already exists!';
        }

        if (! Validator::isNotNull($request['full_name'])) {
            return 'Full name is required!';
        }

        if (! Validator::isNotNull($request['password'])) {
            return 'New password is required!';
        }

        return 0;
    }

}