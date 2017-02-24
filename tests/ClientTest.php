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
    protected function tearDown()
    {
        Client::deleteAll();
        Stylist::deleteAll();
    }

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

    function test_setStylistId()
    {
        //Arrange
        $client_name = 'John Deer';
        $stylist_name1 = 'John Doe';
        $stylist_name2 = 'Jane Doe';
        $test_Stylist1 = new Stylist($stylist_name1);
        $test_Stylist1->save();
        $test_Stylist2 = new Stylist($stylist_name2);
        $test_Stylist2->save();
        $stylist_id1 = $test_Stylist1->getId();
        $stylist_id2 = $test_Stylist2->getId();
        $test_Client = new Client($client_name, $stylist_id1);

        //Act
        $test_Client->setStylistId($stylist_id2);
        $result = $test_Client->getStylistId();

        //Assert
        $this->assertEquals($stylist_id2, $result);
    }

    function test_save()
    {
        //Arrange
        $client_name = 'John Deer';
        $stylist_name = 'John Doe';
        $test_Stylist = new Stylist($stylist_name);
        $test_Stylist->save();
        $stylist_id = $test_Stylist->getId();
        $test_Client = new Client($client_name, $stylist_id);
        $test_Client->save();

        //Act
        $result = Client::getAll();

        //Assert
        $this->assertEquals($test_Client, $result[0]);
    }

    function test_getAll()
    {
        //Arrange
        $client_name1 = 'John Deer';
        $client_name2 = 'Jane Deer';
        $stylist_name = 'John Doe';
        $test_Stylist = new Stylist($stylist_name);
        $test_Stylist->save();
        $stylist_id = $test_Stylist->getId();
        $test_Client1 = new Client($client_name1, $stylist_id);
        $test_Client1->save();
        $test_Client2 = new Client($client_name2, $stylist_id);
        $test_Client2->save();

        //Act
        $result = Client::getAll();

        //Assert
        $this->assertEquals([$test_Client1, $test_Client2], $result);
    }

    function test_deleteAll()
    {
        //Arrange
        $client_name1 = 'John Deer';
        $client_name2 = 'Jane Deer';
        $stylist_name = 'John Doe';
        $test_Stylist = new Stylist($stylist_name);
        $test_Stylist->save();
        $stylist_id = $test_Stylist->getId();
        $test_Client1 = new Client($client_name1, $stylist_id);
        $test_Client1->save();
        $test_Client2 = new Client($client_name2, $stylist_id);
        $test_Client2->save();

        //Act
        Client::deleteAll();
        $result = Client::getAll();

        //Assert
        $this->assertEquals([], $result);
    }

    function test_find()
    {
        //Arrange
        $client_name1 = 'John Deer';
        $client_name2 = 'Jane Deer';
        $stylist_name = 'John Doe';
        $test_Stylist = new Stylist($stylist_name);
        $test_Stylist->save();
        $stylist_id = $test_Stylist->getId();
        $test_Client1 = new Client($client_name1, $stylist_id);
        $test_Client1->save();
        $test_Client2 = new Client($client_name2, $stylist_id);
        $test_Client2->save();

        //Act
        $result = Client::find($test_Client1->getId());

        //Assert
        $this->assertEquals($test_Client1, $result);
    }

    function test_update()
    {
        //Arrange
        $client_name = 'John Deer';
        $new_client_name = 'Jane Deer';
        $stylist_name = 'John Doe';
        $test_Stylist = new Stylist($stylist_name);
        $test_Stylist->save();
        $stylist_id = $test_Stylist->getId();
        $test_Client = new Client($client_name, $stylist_id);
        $test_Client->save();

        //Act
        $test_Client->update($new_client_name);
        $result = $test_Client->getName();

        //Assert
        $this->assertEquals('Jane Deer', $result);
    }
}
?>
