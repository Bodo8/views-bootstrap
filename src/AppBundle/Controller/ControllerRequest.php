<?php
/**
 * Created by PhpStorm.
 * User: boguslaw
 * Date: 24.01.19
 * Time: 11:46
 */


require_once ("../Database/Database.php");
require_once("../Database/impl/InSqlDatabase.php");
require_once("../Entity/TaskBook.php");
require_once("../Entity/DeadlineFactory.php");
require_once("../Entity/DeadlineTask.php");
require_once("../Entity/Task.php");
require_once("../Entity/TaskFactory.php");

class ControllerRequest
{

    public function handlerRequest()
    {
        if ($_POST['action'] === 'save') {
            $database = new InSqlDatabase();
            $taskBook = new TaskBook($database);
            $deadlineNew = [];
            array_push($deadlineNew, $_POST['year']);
            array_push($deadlineNew, $_POST['month']);
            array_push($deadlineNew, $_POST['week']);
            array_push($deadlineNew, $_POST['day']);
            array_push($deadlineNew, $_POST['descriptionTask']);
            array_push($deadlineNew, $_POST['rangeTask']);
            $task = $taskBook->createTask($deadlineNew[4], $deadlineNew[5]);
            $taskBook->createDeadlineTask($deadlineNew[0], $deadlineNew[1],
                $deadlineNew[2], $deadlineNew[3], $task);
            $taskBook->saveTask($deadlineNew);
        } else {
            $database = new InSqlDatabase();
            $taskBook = new TaskBook($database);
            $getParameters = [];
            array_push($getParameters, $_GET['actualYear']);
            array_push($getParameters, $_GET['actualMonth']);
            array_push($getParameters, $_GET['actualWeek']);
            array_push($getParameters, $_GET['actualDay']);
            $taskBook->getTaskForToday($getParameters[0], $getParameters[1],
                $getParameters[2], $getParameters[3]);
        }
    }
}

$controllerRequest = new ControllerRequest();
$controllerRequest->handlerRequest();

