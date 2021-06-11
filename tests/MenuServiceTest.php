<?php

require_once 'classes/Database/DatabaseModel.php';
require_once 'classes/Database/DatabaseTable.php';
require_once 'classes/Validators/Validator.php';
require_once 'classes/Models/MenuImage.php';
require_once 'classes/Models/Menu.php';
require_once 'classes/Services/ImageService.php';
require_once 'classes/admin/Services/MenuService.php';
require_once 'functions/helper.php';

use admin\Services\MenuService;
use Models\Menu;
use PHPUnit\Framework\TestCase;

class MenuServiceTest extends TestCase
{

    private $testRequest = [
        'category_id' => 1,
        'name' => 'Test Name',
        'price' => 0,
        'description' => 'Test Description',
        'category_slug' => 'test-category-slug',
        'visible' => 0,
    ];

    private $id;

    public function testCreateMenu()
    {
        $menuService = new MenuService(getPDO());
        $this->id = $menuService->createMenu($this->testRequest);

        self::assertNotNull( Menu::create(getPDO())->find($this->id)->id, "Menu not created!");

        Menu::create(getPDO())->delete($this->id);

        $this->testRequest['id'] = $this->id;
        $menuService->deleteMenu($this->testRequest);
    }

    public function testUpdateMenu()
    {
        $menuService = new MenuService(getPDO());
        $this->id = $menuService->createMenu($this->testRequest);

        $this->testRequest['visible'] = 0;
        $this->testRequest['id'] = $this->id;

        $menuService->updateMenu($this->testRequest);
        self::assertEquals(0, Menu::create(getPDO())->find($this->id)->visible, "Menu not created!");

        Menu::create(getPDO())->delete($this->id);

        $this->testRequest['id'] = $this->id;
        $menuService->deleteMenu($this->testRequest);
    }

    public function testDeleteMenu()
    {
        $menuService = new MenuService(getPDO());
        $this->id = $menuService->createMenu($this->testRequest);

        Menu::create(getPDO())->delete($this->id);

        $this->testRequest['id'] = $this->id;
        $menuService->deleteMenu($this->testRequest);

        self::assertFalse( isset(Menu::create(getPDO())->find($this->id)->id), "Menu not created!");
    }
}
