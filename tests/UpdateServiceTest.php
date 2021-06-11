<?php

require_once 'classes/Database/DatabaseModel.php';
require_once 'classes/Database/DatabaseTable.php';
require_once 'classes/Validators/Validator.php';
require_once 'classes/Models/Update.php';
require_once 'classes/Services/ImageService.php';
require_once 'classes/admin/Services/UpdateService.php';
require_once 'functions/helper.php';

use admin\Services\UpdateService;
use Models\Update;
use PHPUnit\Framework\TestCase;

class UpdateServiceTest extends TestCase
{

    private $testRequest = [
        'date' => '2021-08-01 01:09:01',
        'title' => 'Test Title',
        'description' => 'Test Description',
        'image_id' => 65,
    ];

    private $id;
    
    public function testUpdateUpdate()
    {
        $updateService = new UpdateService(getPDO());
        $this->id = $updateService->createUpdate($this->testRequest);

        self::assertNotNull( Update::create(getPDO())->find($this->id)->id, "Update not created!");

        Update::create(getPDO())->delete($this->id);

        $this->testRequest['id'] = $this->id;
        $updateService->deleteUpdate($this->testRequest);
    }

    public function testCreateUpdate()
    {
        $updateService = new UpdateService(getPDO());
        $this->id = $updateService->createUpdate($this->testRequest);

        $this->testRequest['title'] = 'Modified';
        $this->testRequest['id'] = $this->id;

        $updateService->updateUpdate($this->testRequest);
        self::assertEquals('Modified', Update::create(getPDO())->find($this->id)->title, "Update not created!");

        Update::create(getPDO())->delete($this->id);

        $this->testRequest['id'] = $this->id;
        $updateService->deleteUpdate($this->testRequest);
    }

    public function testDeleteUpdate()
    {
        $updateService = new UpdateService(getPDO());
        $this->id = $updateService->createUpdate($this->testRequest);

        Update::create(getPDO())->delete($this->id);

        $this->testRequest['id'] = $this->id;
        $updateService->deleteUpdate($this->testRequest);

        self::assertFalse( isset(Update::create(getPDO())->find($this->id)->id), "Update not created!");
    }
}
