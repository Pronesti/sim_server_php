<?php
require_once("../vendor/autoload.php");


use PHPUnit\Framework\TestCase; #namespace

final class ServerInstanceTest extends TestCase{
    function testAlwaysDown(){
        $server = new \Classes\ServerInstance("fail",false,false,false,false,true);
        $this->assertSame(0, $server->call());
    }
    function testAlwaysError(){
        $server = new \Classes\ServerInstance("error",false,false,false,true,false);
        $this->assertSame(500, $server->call());
    }
    function testAlwaysNotFound(){
        $server = new \Classes\ServerInstance("notfound",false,false,true,false,false);
        $this->assertSame(400, $server->call());
    }
    function testAlwaysRedirect(){
        $server = new \Classes\ServerInstance("redirect",false,true,false,false,false);
        $this->assertSame(300, $server->call());
    }
    function testAlwaysOk(){
        $server = new \Classes\ServerInstance("ok",true,false,false,false,false);
        $this->assertSame(200, $server->call());
    }
    function testServerNormal(){
        $server = new \Classes\ServerInstance("normal",true,true,true,true,true);
        $this->assertContains($server->call(), [0,200,300,400,500]);
    }
    function testServerPerfecto(){
        $server = new \Classes\ServerInstance("perfecto",true,true,false,false,false);
        $this->assertContains($server->call(), [200,300]);
    }
    function testServerRoto(){
        $server = new \Classes\ServerInstance("roto",false,false,true,true,true);
        $this->assertContains($server->call(), [0,400,500]);
    }
}