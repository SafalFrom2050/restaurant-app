<?php

namespace admin\Services;


use Models\Menu;
use Models\MenuImage;
use Services\ImageService;

class MenuService {

    public $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public static function create($pdo)
    {
        return new MenuService($pdo);
    }

    public function performAction($request)
    {
        if (!isset($request['_method'])) {
            return;
        }

        $method = strtolower($request['_method']);

        // Check for valid csrf token
        if (!isset($request['token']) || $request['token'] !== $_SESSION['token']){
            echo 'Action Failed! (CSRF token missing or incorrect!)';
            return;
        }

        /** Create menu */

        if ($method === 'post') {
            $this->createMenu($request);
        }

        /** Operations on existing rows */

        if (!isset($request['id'])) {
            return;
        }

        if ($method === 'delete') {
            $this->deleteMenu($request);
        }else if ($method === 'put') {
            $this->updateMenu($request);
        }
    }

    public function createMenu($request)
    {
        $imageService =  ImageService::create('../public/images/menu/');
        $imageService->uploadImage();

        $imageIds = $imageService->getImageId();

        $menu = Menu::with(getPDO(), $request);
        $menuId = $menu->save();

        foreach ($imageIds as $imageId) {
            MenuImage::with(getPDO(), ['image_id' => $imageId, 'menu_id' => $menuId])->save();
        }

        return $menuId;
    }

    public function updateMenu($request)
    {
        $imageService = ImageService::create('../public/images/menu/');
        $imageService->uploadImage();

        $imageIds = $imageService->getImageId();

        $menu = Menu::with(getPDO(), $request);
        $menu->update();

        if (count($imageIds) <= 0) {
            return;
        }

        // removing existing entries before adding new one
        $existingMenuImages = MenuImage::create(getPDO())->findAllHaving('menu_id', $menu->id);
        foreach ($existingMenuImages as $menuImage) {
            $menuImage->delete();
        }

        // Adding new ones
        foreach ($imageIds as $imageId) {
            MenuImage::with(getPDO(), ['image_id' => $imageId, 'menu_id' => $menu->id])->save();
        }
    }

    public function deleteMenu($request) {
        $menu = Menu::create($this->pdo);
        $menu->delete($request['id']);
    }
}