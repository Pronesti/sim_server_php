<?php
include_once("../interfaces/Server.php");
class LoadBalancer implements Server
{
    private $servers = array();
    private $name;
    private $index;

    public function __construct($name, $type)
    {
        $this->name = $name;
        $this->type = $type; // 0 Random, 1 RoundRobin (, 2 priority) opcional
        $this->index = 0;
    }
    public function addServer(Server $s): bool
    {
        $this->servers[] = $s;
        return true;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function call(): int
    {
        switch ($this->type) {
            case 0:
                if (count($this->servers) > 0) {
                    return $this->servers[random_int(0, count($this->servers) - 1)]->call();
                } else {
                    return null;
                }
                break;
            case 1:
                if (count($this->servers) > 0) {
                    $item = $this->servers[$this->index]->call();
                    if ($this->index + 1 < count($this->servers)) {
                        $this->index += 1;
                    } else {
                        $this->index = 0;
                    }
                    return $item;
                } else {
                    return null;
                }
                break;
        }
    }
}
