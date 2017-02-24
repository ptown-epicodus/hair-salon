<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once 'src/Client.php';

$server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

class ClientTest extends PHPUnit_Framework_TestCase
{
    function test_getId()
    {
        //Arrange
        $client_name = 'John Deer';
        $stylist_name = 'John Doe';
        $test_Stylist = new Stylist($stylist_name);
        $test_Stylist->save();
        $stylist_id = $test_Stylist->getId();
        $id = 1;
        $test_Client = new Client($client_name, $stylist_id, $id);

        //Act
        $result = $test_Client->getId();

        //Assert
        $this->assertEquals(1, $result);
    }

    function test_getName()
    {
        //Arrange
        $client_name = 'John Deer';
        $stylist_name = 'John Doe';
        $test_Stylist = new Stylist($stylist_name);
        $test_Stylist->save();
        $stylist_id = $test_Stylist->getId();
        $test_Client = new Client($client_name, $stylist_id);

        //Act
        $result = $test_Client->getName();

        //Assert
        $this->assertEquals('John Deer', $result);
    }

    function test_setName()
    {
        //Arrange
        $client_name1 = 'John Deer';
        $client_name2 = 'Jane Deer';
        $stylist_name = 'John Doe';
        $test_Stylist = new Stylist($stylist_name);
        $test_Stylist->save();
        $stylist_id = $test_Stylist->getId();
        $test_Client = new Client($client_name1, $stylist_id);

        //Act
        $test_Client->setName($client_name2);
        $result = $test_Client->getName();

        //Assert
        $this->assertEquals('Jane Deer', $result);
    }

    function test_getStylistId()
    {
        //Arrange
        $client_name = 'John Deer';
        $stylist_name = 'John Doe';
        $test_Stylist = new Stylist($stylist_name);
        $test_Stylist->save();
        $stylist_id = $test_Stylist->getId();
        $test_Client = new Client($client_name, $stylist_id);

        //Act
        $result = $test_Client->getStylistId();

        //Assert
        $this->assertEquals($stylist_id, $result);
    }
}
?>
