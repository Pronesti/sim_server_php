<?php
require_once("../vendor/autoload.php");

use PHPUnit\Framework\TestCase;

final class LoadBalancerRandomTest extends TestCase
{
    function testExiste()
    {
        $lb = new \Classes\LoadBalancer("random", new \Classes\RandomStrategy);
        $this->assertTrue(true);
    }
    function testAddServer()
    {
        $lb = new \Classes\LoadBalancer("random", new \Classes\RandomStrategy);
        $this->assertTrue($lb->addServer(new \Classes\ServerInstance("server1", true, true, true, true, true)));
    }
    function testAddServerAndRemoves()
    {
        $lb = new \Classes\LoadBalancer("random", new \Classes\RandomStrategy);
        $this->assertTrue($lb->addServer(new \Classes\ServerInstance("server1", true, true, true, true, true)));
        $this->assertTrue($lb->removeServer("server1"));
    }
    function testAddTwoServersAndRemovesOne()
    {
        $lb = new \Classes\LoadBalancer("random", new \Classes\RandomStrategy);
        $this->assertTrue($lb->addServer(new \Classes\ServerInstance("server1", true, true, true, true, true)));
        $this->assertTrue($lb->addServer(new \Classes\ServerInstance("server2", true, true, true, true, true)));
        $this->assertTrue($lb->removeServer("server1"));
    }
    function testCallEmpty()
    {
        $lb = new \Classes\LoadBalancer("random", new \Classes\RandomStrategy);
        try {
            $lb->call();
        } catch (\Exception $e) {
            $this->assertTrue(true);
        }
    }
    function testCall()
    {
        $lb = new \Classes\LoadBalancer("random", new \Classes\RandomStrategy);
        $this->assertTrue($lb->addServer(new \Classes\ServerInstance("server1", true, true, true, true, false)));
        $this->assertNotSame(0, $lb->call());
    }
    function testGetName()
    {
        $lb = new \Classes\LoadBalancer("random", new \Classes\RandomStrategy);
        $this->assertSame("random", $lb->getName());
    }
}
