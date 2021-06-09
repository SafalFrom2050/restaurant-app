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

            $user = Member::create(getPDO())->findByUsername($request['username']);

            if (isset($user->id)) {
                if (password_verify($request['password'], $user->password)) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['user_id'] = $user->id;

                    // Used for csrf protection
                    $_SESSION['token'] = bin2hex(randomString(25));
                }else {
                    echo 'Password is invalid';
                }
            }else {
                echo 'Username is invalid!';
            }
        }
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