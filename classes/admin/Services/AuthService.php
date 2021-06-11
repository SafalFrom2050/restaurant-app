<?php

namespace admin\Services;

use Models\Member;

class AuthService {
    public $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public static function create($pdo)
    {
        return new AuthService($pdo);
    }

    public function performAction($request)
    {
        session_start();

        if (isset($request['submit'], $request['login'])) {
            if ($this->loginUser($request)) {
                // Used for csrf protection
                setSessionToken();
            }
        }
    }

    public function loginUser($request)
    {
        $user = Member::create(getPDO())->findByUsername($request['username']);

        if (isset($user->id)) {
            if (password_verify($request['password'], $user->password)) {
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $user->id;

                return true;
            }
            echo 'Password is invalid';
            return false;
        }

        echo 'Username is invalid!';
        return false;
    }

    public function isLoggedIn()
    {
        return (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true);
    }

    public function getCurrentMember()
    {
        return Member::create(getPDO())->findById($_SESSION['user_id']);
    }
}