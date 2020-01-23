<?php
namespace Classes;

class LoadBalancer implements \Interfaces\Server, \Interfaces\LoadBalancer
{
    private $servers = array();
    private $name;

    public function __construct(String $name, \Interfaces\LoadBalancerStrategy $strategy)
    {
        $this->name = $name;
        $this->strategy = $strategy;
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
    public function getList(): array{
        return $this->servers;
    }
    public function call(): int
    {
        if (count($this->servers) > 0) {
            return $this->strategy->pick($this->servers)->call();
        } else {
            throw new \Exception();
        }
    }
}
