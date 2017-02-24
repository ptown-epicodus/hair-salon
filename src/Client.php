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
        $this->name = (string) $new_name;
    }

    function getStylistId()
    {
        return $this->stylist_id;
    }

    function setStylistId($new_stylist_id)
    {
        $this->stylist_id = (int) $new_stylist_id;
    }

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO clients (name, stylist_id) VALUES ('{$this->getName()}', {$this->getStylistId()});");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    function update($new_name)
    {
        $GLOBALS['DB']->exec("UPDATE clients SET name = '{$new_name}' WHERE id = {$this->getId()};");
        $this->setName($new_name);
    }

    function delete()
    {
        $GLOBALS['DB']->exec("DELETE FROM clients WHERE id = {$this->getId()};");
    }

    static function getAll()
    {
        $queried_clients = $GLOBALS['DB']->query('SELECT * FROM clients;');
        $clients = [];
        foreach ($queried_clients as $client) {
            $name = $client['name'];
            $stylist_id = $client['stylist_id'];
            $id = $client['id'];
            $new_client = new Client($name, $stylist_id, $id);
            array_push($clients, $new_client);
        }
        return $clients;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec('DELETE FROM clients;');
    }

    static function find($search_id)
    {
        $found_client = null;
        $clients = Client::getAll();
        foreach ($clients as $client) {
            $client_id = $client->getId();
            if ($client_id == $search_id)
                $found_client = $client;
        }
        return $found_client;
    }
}
?>
