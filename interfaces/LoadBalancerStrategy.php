<?php
namespace Interfaces;
interface LoadBalancerStrategy{
    public function pick(array $serverList);
}