<?php

require_once 'classes/Database/DatabaseModel.php';
require_once 'classes/Database/DatabaseTable.php';
require_once 'classes/Validators/Validator.php';
require_once 'classes/Models/Category.php';
require_once 'classes/admin/Services/CategoryService.php';
require_once 'functions/helper.php';

use admin\Services\CategoryService;
use Models\Category;
use PHPUnit\Framework\TestCase;

class CategoryServiceTest extends TestCase
{

    private $testRequest = [
        'name' => 'Test Category',
        'slug' => 'test-category',
    ];

    private $id;

    public function testCreateCategory()
    {
        $categoryService = new CategoryService(getPDO());
        $this->id = $categoryService->createCategory($this->testRequest);

        self::assertNotNull( Category::create(getPDO())->findById($this->id)->id, "Category not created!");

        Category::create(getPDO())->delete($this->id);

        $this->testRequest['id'] = $this->id;
        $categoryService->deleteCategory($this->testRequest);
    }

    public function testUpdateCategory()
    {
        $categoryService = new CategoryService(getPDO());
        $this->id = $categoryService->createCategory($this->testRequest);

        $this->testRequest['slug'] = 'test-modified';
        $this->testRequest['id'] = $this->id;

        $categoryService->updateCategory($this->testRequest);
        self::assertEquals('test-modified', Category::create(getPDO())->findById($this->id)->slug, "Category not created!");

        Category::create(getPDO())->delete($this->id);

        $this->testRequest['id'] = $this->id;
        $categoryService->deleteCategory($this->testRequest);
    }

    public function testDeleteCategory()
    {
        $categoryService = new CategoryService(getPDO());
        $this->id = $categoryService->createCategory($this->testRequest);

        Category::create(getPDO())->delete($this->id);

        $this->testRequest['id'] = $this->id;
        $categoryService->deleteCategory($this->testRequest);

        self::assertFalse( isset(Category::create(getPDO())->find($this->id)->id), "Category not created!");
    }
}
