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
}
?>
