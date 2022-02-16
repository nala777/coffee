<?php

require_once "req.php";


$bdd = bdd();

$waiters = $bdd->query('SELECT * FROM waiter');

echo ("Hello World");

echo ("Le petit Chat Par d'heure");


foreach($waiters as $waiter){
    echo "</br>";
    echo $waiter['name'];
 }


?>