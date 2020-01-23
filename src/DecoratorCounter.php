<?php

namespace Classes;

class DecoratorCounter implements \Interfaces\Server, \Interfaces\LoadBalancer
{
    private $object;
    private $conn;
    public function __construct($s)
    {
        $this->object = $s;
    }
    public function getName()
    {
        return "Deco: " . $this->object->getName();
    }
    public function call()
    {
        $this->conn +=1;
        return $this->object->call();
    }
    public function addServer(\Interfaces\Server $s)
    {
        return $this->object->addServer($s);
    }
    public function removeServer(String $name)
    {
        return $this->object->removeServer($name);
    }
    public function getList()
    {
        return $this->object->getList();
    }
    public function getConnections(){
        return $this->conn;
    }
}
