<?php


class InSqlDatabase implements Database
{
    public function saveTask(DeadlineTask $deadlineTask)
    {
        $instanceConnectDB = ConnectMySQL::getInstance();
        $connectDb = $instanceConnectDB->getConnectDb();
        if ($connectDb != null) {

            $sqlQueryTask = "INSERT INTO `tasks`(`task_id`, `description`, `range_task`) 
                             VALUES (NULL, ?, ?)";
            $deadlineQuery = "INSERT INTO `dead_line`(`date_id`, `years`, `months`, `weeks`, `days`, `task_id`)
                              VALUES (NULL, ?, ?, ?, ?, ?)";
            try {

                if ($statementQuery = $connectDb->prepare($sqlQueryTask)) {
                    $statementQuery->bind_param("si",
                        $deadlineTask->getTask()->getDescription(),
                        $deadlineTask->getTask()->isImportantTask());
                    $statementQuery->execute();
                    $lastId = mysqli_insert_id($connectDb);

                    if ($deadlineStatement = $connectDb->prepare($deadlineQuery)) {
                        $deadlineStatement->bind_param("iiiii", $deadlineTask->getYear(), $deadlineTask->getMonth(),
                            $deadlineTask->getWeek(), $deadlineTask->getDay(), $lastId);
                        $deadlineStatement->execute();
                    } else {
                        print(json_encode(array("Don't execute deadline query")));
                    }

                } else {
                    print(json_encode(array("Don't execute task query")));
                }

            } catch (Exception $e) {
                print (json_encode("ERROR", "PHP EXCEPTION: CANT'T SAVE TO MYSQL." . $e->getMessage()));

            } finally {
                $connectDb->close();
            }

        } else {
            print (json_encode("ERROR", "PHP EXCEPTION: CANT'T CONNECT TO MYSQL."));
        }

    }

    public function getTaskForToday(int $year, int $month, int $week, int $day)
    {
        $idListFromDatabase = [];
        $taskListFromDatabase = [];
        $instanceConnectDB = ConnectMySQL::getInstance();
        $connectDb = $instanceConnectDB->getConnectDb();

        if ($connectDb != null) {
            $getQuery = "SELECT `date_id`, `years`, `months`, `weeks`, `days`, `task_id` FROM `dead_line` WHERE 
                          years=? AND months=? AND weeks=? AND days=?";
            $taskQuery = "SELECT `task_id`, `description`, `range_task` FROM `tasks` WHERE task_id=?";

            if ($getStatementQuery = $connectDb->prepare($getQuery)) {

                if ($getStatementQuery->bind_param("iiii", $year,
                    $month, $week, $day)) {
                    $getStatementQuery->execute();
                    $result = $getStatementQuery->get_result();
                    if ($result->num_rows > 0) {

                        while ($row = $result->fetch_array()) {
                            array_push($idListFromDatabase, $row["task_id"]);
                        }
                        foreach ($idListFromDatabase as $idTask) {

                            if ($getStatementQuery = $connectDb->prepare($taskQuery)) {

                                if ($getStatementQuery->bind_param("i", $idTask)) {
                                    $getStatementQuery->execute();
                                    $result = $getStatementQuery->get_result();
                                    $row = $result->fetch_array();
                                    array_push($taskListFromDatabase, $row["description"]);
                                } else {
                                    echo("PHP EXCEPTION: CAN'T BIND PARAM TO TASK QUERY SQL ");
                                }
                            } else {
                                echo("PHP EXCEPTION: CANT'T PREPARE QUERY TO MYSQL.");
                            }
                        }
                        print (json_encode($taskListFromDatabase));

                    } else {
                        print (json_encode(array("You don't have any tasks today.")));
                    }
                } else {
                    echo("PHP EXCEPTION: CAN'T BIND PARAM TO DEADLINE QUERY SQL ");
                }
            } else {
                echo("PHP EXCEPTION: CANT'T PREPARE DEADLINE QUERY TO MYSQL.");
            }
            $connectDb->close();
        } else {
            echo ("PHP EXCEPTION: CANT'T CONNECT TO MYSQL.");
        }
    }

    public function createDeadlineTask(int $year, int $month, int $week, int $day, Task $task): DeadlineTask
    {
        $director = DeadlineFactory::director();
        $deadlineTask = $director->createWithParameters($year, $month,
            $week, $day, $task);
        return $deadlineTask;
    }

    public function createTask(string $description,
                               bool $importantTask): Task
    {
        $director = TaskFactory::director();
        $task = $director->createWithoutId($description, $importantTask);
        return $task;
    }

}