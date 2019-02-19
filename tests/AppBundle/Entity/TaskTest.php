<?php

require_once("../../../src/AppBundle/Entity/Task.php");

class TaskTest extends \PHPUnit\Framework\TestCase
{

    public function testCreateTask()
    {
        $expectDescription = "buy bread";
        $expectedId = 1;
        $task = new Task($expectedId, $expectDescription, false);
        $actualDescription = $task->getDescription();
        $actualId = $task->getTaskId();
        $this->assertEquals($expectDescription, $actualDescription);
        $this->assertEquals($expectedId, $actualId);
    }
}
