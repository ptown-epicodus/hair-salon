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
}
?>
