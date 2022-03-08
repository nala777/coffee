<?php

require('vendor/autoload.php');
use Carbon\Carbon;

if($_SERVER['HTTP_HOST'] !=  "coffee-k6-nlc.herokuapp.com") {
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->load();
}
require ('./CoffeeOrm.php');
require('./Waiter.php');
require('Edible.php');

$waiters1 = Waiter::allData();
foreach ($waiters1 as $waiter) { print "<br/>" . $waiter["name"]; }

echo("<br/>");
echo("----------");
echo("<br/>");

$waiters2 = Waiter::all();
foreach ($waiters2 as $waiter) { print "<br/>" . $waiter->getFormatedName(); }

echo("<br/>");
echo("----------");
echo("<br/>");

$edibles1 =Edible::allData();
foreach ($edibles1 as $edible) { print "<br/>" . $edible["name"]; }

echo("<br/>");
echo("----------");
echo("<br/>");

$edibles2 =Edible::all();
foreach ($edibles2 as $edible) { print "<br/>" . $edible->getName(); }


