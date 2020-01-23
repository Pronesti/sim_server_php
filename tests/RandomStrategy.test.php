<?php
require_once("../vendor/autoload.php");

use PHPUnit\Framework\TestCase;

final class RandomStrategyTest extends TestCase
{
    function testPick(){
        $randomS = new \Classes\RandomStrategy;
        $server1 = new \Classes\ServerInstance("server1", true, true, true ,true ,true);
        $server2 = new \Classes\ServerInstance("server2", true, true, true ,true ,true);
        $server3 = new \Classes\ServerInstance("server3", true, true, true ,true ,true);
        $this->assertContains($randomS->pick(array($server1,$server2,$server3)),array($server1,$server2,$server3));
    }
}
