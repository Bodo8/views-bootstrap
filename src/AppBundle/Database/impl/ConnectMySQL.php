<?php
/**
 * Created by PhpStorm.
 * User: boguslaw
 * Date: 23.02.19
 * Time: 09:48
 */

class ConnectMySQL
{
    private $connect;

    /**
     * ConnectMySQL constructor.
     */
    public function __construct()
    {
    }

    public function getConnect(): mysqli
    {
        if ($this->connect === null) {
            try {
                $connectDb = new \mysqli("localhost", "root", "aramej4",
                    "list_task", "3306");
                $connectDb->set_charset("utf8mb4_unicode_ci");

            } catch (Exception $e) {
                print (json_encode("ERROR", "PHP EXCEPTION: CANT'T CONNECT TO MYSQL." . $e->getMessage()));

            }
            return $connectDb;
        } else {
            return $this->connect;
        }
    }
}