<?php
/**
 * Created by PhpStorm.
 * User: boguslaw
 * Date: 23.02.19
 * Time: 19:02
 */

require_once ("../../../../src/AppBundle/Database/impl/ConnectMySQL.php");

class ConnectMySQLTest extends \PHPUnit\Framework\TestCase
{
    public function testGetInstance()
    {
        $instanceConnect = ConnectMySQL::getInstance();
        $instanceConnectTwo = ConnectMySQL::getInstance();
        $this->assertEquals($instanceConnect, $instanceConnectTwo);
    }
}
