<?php

namespace Classes;

class RoundStrategy implements \Interfaces\LoadBalancerStrategy
{
    private $index = 0;
    public function pick(array $serverList)
    {
        $item = $serverList[$this->index];
        if ($this->index + 1 < count($serverList)) {
            $this->index += 1;
        } else {
            $this->index = 0;
        }
        return $item;
    }
}
