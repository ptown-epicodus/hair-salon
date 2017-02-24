<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once 'src/Stylist.php';

$server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

class StylistTest extends PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        Stylist::deleteAll();
    }

    function test_getId()
    {
        //Arrange
        $name = 'John Doe';
        $id = 1;
        $test_Stylist = new Stylist($name, $id);

        //Act
        $result = $test_Stylist->getId();

        //Assert
        $this->assertEquals(1, $result);
    }

    function test_getName()
    {
        //Arrange
        $name = 'John Doe';
        $test_Stylist = new Stylist($name);

        //Act
        $result = $test_Stylist->getName();

        //Assert
        $this->assertEquals('John Doe', $result);
    }

    function test_setName()
    {
        //Arrange
        $name = 'John Doe';
        $new_name = 'Jane Doe';
        $test_Stylist = new Stylist($name);

        //Act
        $test_Stylist->setName($new_name);
        $result = $test_Stylist->getName();

        //Assert
        $this->assertEquals('Jane Doe', $result);
    }

    function test_save()
    {
        //Arrange
        $name = 'John Doe';
        $test_Stylist = new Stylist($name);
        $test_Stylist->save();

        //Act
        $result = Stylist::getAll();

        //Assert
        $this->assertEquals($test_Stylist, $result[0]);
    }

    function test_getAll()
    {
        //Arrange
        $name1 = 'John Doe';
        $name2 = 'Jane Doe';
        $test_Stylist1 = new Stylist($name1);
        $test_Stylist1->save();
        $test_Stylist2 = new Stylist($name2);
        $test_Stylist2->save();

        //Act
        $result = Stylist::getAll();

        //Assert
        $this->assertEquals([$test_Stylist1, $test_Stylist2], $result);
    }

    function test_deleteAll()
    {
        //Arrange
        $name1 = 'John Doe';
        $name2 = 'Jane Doe';
        $test_Stylist1 = new Stylist($name1);
        $test_Stylist1->save();
        $test_Stylist2 = new Stylist($name2);
        $test_Stylist2->save();

        //Act
        Stylist::deleteAll();
        $result = Stylist::getAll();

        //Assert
        $this->assertEquals([], $result);
    }

    function test_find()
    {
        //Arrange
        $name1 = 'John Doe';
        $name2 = 'Jane Doe';
        $test_Stylist1 = new Stylist($name1);
        $test_Stylist1->save();
        $test_Stylist2 = new Stylist($name2);
        $test_Stylist2->save();

        //Act
        $result = Stylist::find($test_Stylist1->getId());

        //Assert
        $this->assertEquals($test_Stylist1, $result);
    }

    function test_update()
    {
        //Arrange
        $name = 'John Doe';
        $new_name = 'Jane Doe';
        $test_Stylist = new Stylist($name);
        $test_Stylist->save();

        //Act
        $test_Stylist->update($new_name);
        $result = $test_Stylist->getName();

        //Assert
        $this->assertEquals('Jane Doe', $result);
    }

    function test_delete()
    {
        //Arrange
        $name1 = 'John Doe';
        $name2 = 'Jane Doe';
        $test_Stylist1 = new Stylist($name1);
        $test_Stylist1->save();
        $test_Stylist2 = new Stylist($name2);
        $test_Stylist2->save();

        //Act
        $test_Stylist1->delete();
        $result = Stylist::getAll();

        //Assert
        $this->assertEquals([$test_Stylist2], $result);
    }

    function test_getClients()
    {
        //Arrange
        $name1 = 'John Doe';
        $name2 = 'Jane Doe';
        $test_Stylist1 = new Stylist($name1);
        $test_Stylist1->save();
        $test_Stylist2 = new Stylist($name2);
        $test_Stylist2->save();
        $stylist_id1 = $test_Stylist1->getId();
        $stylist_id2 = $test_Stylist2->getId();

        $client_name1 = 'John Deer';
        $client_name2 = 'Jane Deer';
        $client_name3 = 'James Deer';
        $test_Client1 = new Client($client_name1, $stylist_id1);
        $test_Client1->save();
        $test_Client2 = new Client($client_name2, $stylist_id1);
        $test_Client2->save();
        $test_Client3 = new Client($client_name3, $stylist_id2);
        $test_Client3->save();

        //Act
        $result = $test_Stylist1->getClients();

        //Arrange
        $this->assertEquals([$test_Client1, $test_Client2], $result);
    }
}
?>
