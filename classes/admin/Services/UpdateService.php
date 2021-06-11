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
            $this->createUpdate($request);
        }

        /** Operations on existing rows */

        if (!isset($request['id'])) {
            return;
        }

        if ($method === 'delete') {
            $this->deleteUpdate($request);
        }else if ($method === 'put') {
            $this->updateUpdate($request);
        }
    }

    public function createUpdate($request)
    {
        $imageService =  ImageService::create('../public/images/updates/');
        $imageService->uploadImage();

        $update = Update::with(getPDO(), $request);
        if (isset($imageService->getImageId()[0])){
            $update->imageId = $imageService->getImageId()[0];
        }
        $id = $update->save();
        echo 'Update has been added successfully!';
        return $id;
    }

    public function updateUpdate($request)
    {
        $imageService =  ImageService::create('../public/images/updates/');
        $imageService->uploadImage();

        $update = Update::with(getPDO(), $request);
        if (isset($imageService->getImageId()[0])){
            $update->imageId = $imageService->getImageId()[0];
        }
        $update->update();

        echo 'Update has been edited!';
    }

    public function deleteUpdate($request)
    {
        $update = Update::create($this->pdo);
        $update->delete($request['id']);
        echo 'Update has been deleted!';
    }
}