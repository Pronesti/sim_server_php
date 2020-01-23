<?php
require_once("../vendor/autoload.php");

use PHPUnit\Framework\TestCase;

final class LoadBalancerRoundTest extends TestCase{
    function testExiste()
    {
        $lb = new \Classes\LoadBalancerRound("Round");
        $this->assertTrue(true);
    }
    function testAddServer()
    {
        $lb = new \Classes\LoadBalancerRound("Round");
        $this->assertTrue($lb->addServer(new \Classes\ServerInstance("server1", true, true, true, true, true)));
    }
    function testAddServerAndRemoves()
    {
        $lb = new \Classes\LoadBalancerRound("Round");
        $this->assertTrue($lb->addServer(new \Classes\ServerInstance("server1", true, true, true, true, true)));
        $this->assertTrue($lb->removeServer("server1"));
    }
    function testAddTwoServersAndRemovesOne()
    {
        $lb = new \Classes\LoadBalancerRound("Round");
        $this->assertTrue($lb->addServer(new \Classes\ServerInstance("server1", true, true, true, true, true)));
        $this->assertTrue($lb->addServer(new \Classes\ServerInstance("server2", true, true, true, true, true)));
        $this->assertTrue($lb->removeServer("server1"));
    }
    function testCallEmpty(){
        $lb = new \Classes\LoadBalancerRound("Round");
        try{
            $lb->call();
        }catch(\Exception $e){
            $this->assertTrue(true);
        }
    }
    function testCall(){
        $lb = new \Classes\LoadBalancerRound("Round");
        $this->assertTrue($lb->addServer(new \Classes\ServerInstance("server1", true, true, true, true, false)));
        $this->assertNotSame(0, $lb->call());
    }
    function testGetName(){
        $lb = new \Classes\LoadBalancerRound("Round");
        $this->assertSame("Round", $lb->getName());
    }
    function testRoundRobin(){
        $lb = new \Classes\LoadBalancerRound("Round");
        $this->assertTrue($lb->addServer(new \Classes\ServerInstance("server1", true, false, false, false, false)));
        $this->assertTrue($lb->addServer(new \Classes\ServerInstance("server2", false, true, false, false, false)));
        $this->assertSame(200, $lb->call());
        $this->assertSame(300, $lb->call());
    }
}