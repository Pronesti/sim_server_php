<?php
require_once("../vendor/autoload.php");

use PHPUnit\Framework\TestCase;

final class RoundStrategyTest extends TestCase
{
    function testPick(){
        $roundS = new \Classes\RoundStrategy;
        $server1 = new \Classes\ServerInstance("server1", true, false, false ,false ,false);
        $server2 = new \Classes\ServerInstance("server2", false, true, false ,false ,false);
        $server3 = new \Classes\ServerInstance("server3", false, false, false ,true ,false);
        $this->assertSame($server1, $roundS->pick(array($server1,$server2,$server3)));
        $this->assertSame($server2, $roundS->pick(array($server1,$server2,$server3)));
        $this->assertSame($server3, $roundS->pick(array($server1,$server2,$server3)));
    }
}
