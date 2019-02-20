<?php


class MySqlAdapter
{

    public function connect()
    {
        $connectDb = null;
        try {

            $connectDb = new \mysqli("localhost", "root", "aramej4",
                "list_task", "3306");
            $connectDb->set_charset("utf8mb4_unicode_ci");

        } catch (Exception $e) {
            print (json_encode("ERROR", "PHP EXCEPTION: CANT'T CONNECT TO MYSQL." . $e->getMessage()));

        }
        return $connectDb;
    }

    public function insertPost($taskToDatabase)
    {
        $year = $taskToDatabase[0];
        $month = $taskToDatabase[1];
        $week = $taskToDatabase[2];
        $day = $taskToDatabase[3];
        $descriptionTask = $taskToDatabase[4];
        $rangeTask = $taskToDatabase[5];

        $connectDb = $this->connect();
        if ($connectDb != null) {

            $sqlQueryTask = "INSERT INTO `tasks`(`task_id`, `description`, `range_task`) 
                             VALUES (NULL, ?, ?)";
            $deadlineQuery = "INSERT INTO `dead_line`(`date_id`, `years`, `months`, `weeks`, `days`, `task_id`)
                              VALUES (NULL, ?, ?, ?, ?, ?)";

            try {

                if ($statementQuery = $connectDb->prepare($sqlQueryTask)) {
                    $statementQuery->bind_param("si", $descriptionTask, $rangeTask);
                    $statementQuery->execute();
                    $lastId = mysqli_insert_id($connectDb);

                    if ($deadlineStatement = $connectDb->prepare($deadlineQuery)) {
                        $deadlineStatement->bind_param("iiiii", $year, $month, $week, $day, $lastId);
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

    public function selectPost($getParameters)
    {
        $idListFromDatabase = [];
        $taskListFromDatabase = [];
        $connectDB = $this->connect();

        if ($connectDB != null) {
            $getQuery = "SELECT `date_id`, `years`, `months`, `weeks`, `days`, `task_id` FROM `dead_line` WHERE 
                          years=? AND months=? AND weeks=? AND days=?";
            $taskQuery = "SELECT `task_id`, `description`, `range_task` FROM `tasks` WHERE task_id=?";

            if ($getStatementQuery = $connectDB->prepare($getQuery)) {

                if ($getStatementQuery->bind_param("iiii", $getParameters[0],
                    $getParameters[1], $getParameters[2], $getParameters[3])) {
                    $getStatementQuery->execute();
                    $result = $getStatementQuery->get_result();
                    if ($result->num_rows > 0) {

                        while ($row = $result->fetch_array()) {
                            array_push($idListFromDatabase, $row["task_id"]);
                        }
                        foreach ($idListFromDatabase as $idTask) {

                            if ($getStatementQuery = $connectDB->prepare($taskQuery)) {

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
            $connectDB->close();
        } else {
            echo ("PHP EXCEPTION: CANT'T CONNECT TO MYSQL.");
        }
    }
}
