<?php
require_once __DIR__ . '/../src/Stylist.php';

class Client
{
    private $id;
    private $name;
    private $stylist_id;

    function __construct($name, $stylist_id, $id = null)
    {
        $this->name = $name;
        $this->stylist_id = $stylist_id;
        $this->id = $id;
    }

    function getId()
    {
        return $this->id;
    }

    function getName()
    {
        return $this->name;
    }

    function setName($new_name)
    {
        $this->name = $new_name;
    }

    function getStylistId()
    {
        return $this->stylist_id;
    }

    function setStylistId($new_stylist_id)
    {
        $this->stylist_id = $new_stylist_id;
    }
}
?>
