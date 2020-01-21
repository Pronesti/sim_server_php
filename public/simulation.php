<?php
include_once("../classes/LoadBalancer.php");
include_once("../classes/ServerInstance.php");

$load1 = new LoadBalancer("load1", 0);
$load2 = new LoadBalancer("load2", 1);
$load1->addServer($load2);
$server1 = new ServerInstance("anda maso", true, true, true, false, false);
$server2 = new ServerInstance("malo", false, false, true, true, true);
$load2->addServer($server1);
$load2->addServer($server2);


$i=0;
while($i<500){
    echo $load1->call();
    echo "</br>";
    $i++;
}