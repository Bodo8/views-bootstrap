<?php
/**
 * Created by PhpStorm.
 * User: boguslaw
 * Date: 23.02.19
 * Time: 09:48
 */

class ConnectMySQL
{
    private static $instance;
    private $connectDb;

    /**
     * ConnectMySQL constructor.
     */
    private function __construct()
    {
        try {
            $this->connectDb = new \mysqli("localhost", "root", "aramej4",
                "list_task", "3306");
            $this->connectDb->set_charset("utf8mb4_unicode_ci");

        } catch (Exception $e) {
            print (json_encode("ERROR", "PHP EXCEPTION: CANT'T CONNECT TO MYSQL." . $e->getMessage()));

        }
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
           self::$instance = new ConnectMySQL();
        }
        return self::$instance;
    }

    /**
     * @return mysqli
     */
    public function getConnectDb(): mysqli
    {
        return $this->connectDb;
    }

    private function __clone() { }
}