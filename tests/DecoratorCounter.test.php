<?php
require_once("../vendor/autoload.php");

use Classes\DecoratorCounter;
use PHPUnit\Framework\TestCase;

final class DecoratorCounterTest extends TestCase
{
    function testGetName()
    {
        $deco = new DecoratorCounter(new \Classes\ServerInstance("server", true, true, true, true, true));
        $this->assertSame("Deco: server", $deco->getName());
    }
    function testCallAndGetConnections()
    {
        $deco = new DecoratorCounter(new \Classes\ServerInstance("server", true, true, true, true, true));
        $deco->call();
        $this->assertSame(1, $deco->getConnections());
    }
}
