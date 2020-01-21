<?php
/* CODIGOS
0->CAIDO
200->OK
300->REDIRECT
400->NOT FOUND
500->ERROR
*/
Interface Server{
    public function getName();
    public function call();
}