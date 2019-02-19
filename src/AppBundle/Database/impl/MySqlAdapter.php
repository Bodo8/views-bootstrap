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
        $connectDB = $this->connect();

        if ($connectDB != null) {
            $getQuery = "SELECT `date_id`, `years`, `months`, `weeks`, `days`, `task_id` FROM `dead_line` WHERE 
                          years=? AND months=? AND weeks=? AND days=?";

            if ($getStatementQuery = $connectDB->prepare($getQuery)) {

                $getStatementQuery->bind_param("iiii", $getParameters[0],
                    $getParameters[1], $getParameters[2], $getParameters[3]);

                $getStatementQuery->execute();
                $result = $getStatementQuery->get_result();
                if ($result->num_rows > 0) {
                    $deadlineRows = [];
                    while ($row = $result->fetch_array()) {

                        array_push($deadlineRows, $row["task_id"]);
                    }
                    print (json_encode($deadlineRows));


                } else {
                    echo("PHP EXCEPTION: CANT'T RETRIEVE FROM MYSQL.");
                }
            } else {
                print (json_encode(array("PHP EXCEPTION: CANT'T PREPARE QUERY TO MYSQL.")));
            }
            $connectDB->close();
        } else {
            print (json_encode(array("PHP EXCEPTION: CANT'T CONNECT TO MYSQL.")));
        }
    }
}

//$funT = new MySqlAdapter();
//$funT->selectPost();
//$arr = [2019, 1, 4, 22,"stars88", 0];
//$funT->insertPost($arr);
