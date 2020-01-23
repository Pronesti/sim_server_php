<?php
namespace Classes;
class RandomStrategy implements \Interfaces\LoadBalancerStrategy{
    public function pick(array $serverList){
        return $serverList[random_int(0, count($serverList) - 1)];
    }
}