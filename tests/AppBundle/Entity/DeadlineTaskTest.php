<?php

require_once("../../../src/AppBundle/Entity/Task.php");
require_once("../../../src/AppBundle/Entity/DeadlineTask.php");
require_once("../../../src/AppBundle/Entity/DeadlineFactory.php");

use PHPUnit\Framework\TestCase;

class DeadlineTaskTest extends TestCase
{

    public function testConstruct()
    {
        $expectedYear = 2018;
        $expectedMonth = 12;
        $expectedWeek = 51;
        $expectedDay = 19;
        $task = new Task(1, "to buy bread", false);

        $deadLineTask = new DeadlineTask($expectedYear, $expectedMonth,
            $expectedWeek, $expectedDay, $task);
        $actualYear = $deadLineTask->getYear();
        $actualMonth = $deadLineTask->getMonth();
        $actualWeek = $deadLineTask->getWeek();
        $actualDay = $deadLineTask->getDay();
        $actualTask = $deadLineTask->getTask();

        $this->assertEquals($expectedYear, $actualYear);
        $this->assertEquals($expectedMonth, $actualMonth);
        $this->assertEquals($expectedWeek, $actualWeek);
        $this->assertEquals($expectedDay, $actualDay);
        $this->assertSame($task, $actualTask);
    }
}
