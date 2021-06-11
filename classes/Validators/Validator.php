<?php

namespace Validators;


use Models\Member;

class Validator {

    public static function isNotNull($str)
    {
        return !empty($str);
    }

    public static function hasLength($str, $len)
    {
        return strlen($str) >= $len;
    }

    public static function isUniqueUsername($str)
    {

        $member = Member::create(getPDO())->findByKey('username', $str);

        return !isset($member->id);
    }
}