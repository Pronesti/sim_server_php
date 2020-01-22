<?php
namespace Classes;

class LoadBalancerRound implements \Interfaces\Server, \Interfaces\LoadBalancer
{
    private $servers = array();
    private $name;
    private $index;

    public function __construct($name)
    {
        $this->name = $name;
        $this->index = 0;
    }
    public function addServer(\Interfaces\Server $s): bool
    {
        foreach($this->servers as $v){
            if($s->getName() === $v->getName()){
                return false;
            }
        }
        $this->servers[] = $s;
        return true;
    }
    public function removeServer($name): bool
    {
        foreach($this->servers as $k => $v){
            if($v->getName() === $name){
                unset($this->servers[$k]);
                $this->servers = array_values($this->servers);
                return true;
            }
            return false;
        }
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function call(): int
    {
        if (count($this->servers) > 0) {
            $item = $this->servers[$this->index]->call();
            if ($this->index + 1 < count($this->servers)) {
                $this->index += 1;
            } else {
                $this->index = 0;
            }
            return $item;
        } else {
            throw new \Exception();
        }
    }
}
