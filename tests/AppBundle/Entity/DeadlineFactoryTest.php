<?php
/**
 * Created by PhpStorm.
 * User: boguslaw
 * Date: 23.12.18
 * Time: 06:48
 */


require_once("../../../src/AppBundle/Entity/Task.php");
require_once("../../../src/AppBundle/Entity/DeadlineTask.php");
require_once("../../../src/AppBundle/Entity/DeadlineFactory.php");

use PHPUnit\Framework\TestCase;

class DeadlineFactoryTest extends TestCase
{

    public function testCreateWithParameters()
    {
        $task = new Task(1, "to buy some", true);

        $expectedYear = 2018;
        $expectedMonth = 12;
        $expectedWeek = 51;
        $expectedDay = 19;
        $director = DeadlineFactory::director();
        $deadlineTask = $director->createWithParameters($expectedYear, $expectedMonth,
            $expectedWeek, $expectedDay, $task);
        $actualYear = $deadlineTask->getYear();
        $actualMonth = $deadlineTask->getMonth();
        $actualWeek = $deadlineTask->getWeek();
        $actualDay = $deadlineTask->getDay();
        $this->assertEquals($expectedYear, $actualYear);
        $this->assertEquals($expectedMonth, $actualMonth);
        $this->assertEquals($expectedWeek, $actualWeek);
        $this->assertEquals($expectedDay, $actualDay);
    }
}
