<?php

namespace admin\Services;


use Models\Image;
use Models\Update;
use Services\ImageService;

class UpdateService {
    public $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public static function create($pdo)
    {
        return new UpdateService($pdo);
    }

    public function performAction($request)
    {
        if (!isset($request['_method'])) {
            return;
        }

        $method = strtolower($request['_method']);

        // Check for valid csrf token

        try_session_start();
        if (!isset($request['token']) || $request['token'] !== $_SESSION['token']){
            echo 'Action Failed! (CSRF token missing or incorrect!)';
            return;
        }

        /** Create */

        if ($method === 'post') {
            $imageService =  ImageService::create('../public/images/updates/');
            $imageService->uploadImage();

            $update = Update::with(getPDO(), $request);
            $update->imageId = $imageService->getImageId();
            $update->save();
            echo 'Update has been added successfully!';
            header('location: /admin/updates');
        }

        /** Operations on existing rows */

        if (!isset($request['id'])) {
            return;
        }

        if ($method === 'delete') {
            $update = Update::create($this->pdo);
            $update->delete($request['id']);
        }else if ($method === 'put') {
            $imageService =  ImageService::create('../public/images/updates/');
            $imageService->uploadImage();

            $update = Update::with(getPDO(), $request);
            if ($imageService->getImageId() !== null){
                $update->imageId = $imageService->getImageId();
            }
            $update->update();

            echo 'Update has been edited successfully!';
            header('location: /admin/updates');
        }
    }
}