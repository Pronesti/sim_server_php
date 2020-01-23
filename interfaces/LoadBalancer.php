<?php
namespace Interfaces;

Interface LoadBalancer{
    public function addServer(Server $s);
    public function removeServer(String $s);
    public function getList();
}