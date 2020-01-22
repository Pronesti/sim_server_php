<?php
namespace Classes;

class ServerInstance implements \Interfaces\Server
{
    private $puede;
    private $name;
    
    public function __construct($name, $ok, $redirect, $notFound, $error, $down)
    {
        $this->name = $name;
        $this->puede = [200 => $ok, 300 => $redirect, 400 => $notFound, 500 => $error, 0 => $down];
    }
    public function call()
    {
        $newArray = array();
        foreach ($this->puede as $k => $v) {
            if ($v) {
                $newArray[] = $k;
            }
        }
        if (count($newArray) > 0) {
            return $newArray[random_int(0, count($newArray) - 1)];
        } else {
            return null;
        }
    }

    public function getName()
    {
        return $this->name;
    }
}
