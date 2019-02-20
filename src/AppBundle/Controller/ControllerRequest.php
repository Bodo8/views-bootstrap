<?php
/**
 * Created by PhpStorm.
 * User: boguslaw
 * Date: 24.01.19
 * Time: 11:46
 */


require_once("../Database/impl/MySqlAdapter.php");

class ControllerRequest
{

    public function handlerRequest()
    {
        if ($_POST['action'] === 'save') {
            $mySqlAdapter = new MySqlAdapter();
            $deadlineNew = [];
            array_push($deadlineNew, $_POST['year']);
            array_push($deadlineNew, $_POST['month']);
            array_push($deadlineNew, $_POST['week']);
            array_push($deadlineNew, $_POST['day']);
            array_push($deadlineNew, $_POST['descriptionTask']);
            array_push($deadlineNew, $_POST['rangeTask']);
            $mySqlAdapter->insertPost($deadlineNew);
        } else {
            $mySqlAdapter = new MySqlAdapter();
            $getParameters = [];
            array_push($getParameters, $_GET['actualYear']);
            array_push($getParameters, $_GET['actualMonth']);
            array_push($getParameters, $_GET['actualWeek']);
            array_push($getParameters, $_GET['actualDay']);
            $mySqlAdapter->selectPost($getParameters);
        }
    }
}

$controllerRequest = new ControllerRequest();
$controllerRequest->handlerRequest();

