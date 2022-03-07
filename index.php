<?php
use Carbon\Carbon;
require('vendor/autoload.php');


if($_SERVER['HTTP_HOST'] != "coffee-nala.herokuapp.com"){
  $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->load();
}
function dbaccess() {
  $dbConnection = "mysql:dbname=". $_ENV['DB_NAME'] ."; host=". $_ENV['DB_HOST'] .":". $_ENV['DB_PORT'] ."; charset=utf8";
  $user = $_ENV['DB_USERNAME'];
  $pwd = $_ENV['DB_PASSWORD'];
  
  $db = new PDO ($dbConnection, $user, $pwd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  return $db;
}
  
$db = dbaccess();

// $req = $db->query('SELECT name FROM waiter')->fetchAll();

// foreach ($req as $dbreq) {
//   echo $dbreq['name'] . "<br>";
// }

// $req = $db->query('SELECT * FROM edible')->fetchAll();

// foreach ($req as $dbreq) {
//   echo $dbreq['name'] ." ". $dbreq['price'] ."€ <br>";
// }

// $reqCoffee = $db->query("SELECT name, price FROM edible WHERE FORMAT(price, 1) = 1.3")->fetchAll();


// forEach ($reqCoffee as $coffee){
//   echo $coffee['name'] . " " . $coffee['price'] ."euros" . "<br>";
// }

// ?>

<?php 
$reqOrder = $db->query("SELECT * FROM `orderedible` WHERE idOrder = 1")->fetchAll();
$price = 0;

forEach($reqOrder as $order){
  $price = $price + $order['price']*$order['quantity'];
}

echo "<h1>Facture</h1><br>";

echo "Prix de la facture 1 : " . $price . " €<br>";





$reqCA2 = $db->query("SELECT idWaiter,idOrder,FORMAT(SUM(price*quantity),2) AS ca FROM `orderedible`,`order` WHERE orderedible.idOrder =`order`.id AND idWaiter = 2")->fetch(PDO::FETCH_OBJ);
echo "CA serveur 2 : " . $reqCA2->ca . " €<br>";



$reqquantite = $db->query("SELECT idRestaurantTable,idOrder,quantity FROM `orderedible`,`order` WHERE orderedible.idOrder =`order`.id AND idRestaurantTable = 3")->fetchAll();
$quantite = 0;

forEach($reqquantite as $qu){
  $quantite = $quantite +$qu['quantity'];
}

echo "Nombre Café Table 3 : " . $quantite . " café(s)<br>";


$reqTable3= $db->query("SELECT waiter.name FROM `order`,waiter WHERE `order`.idWaiter = waiter.id AND order.idRestaurantTable = 3;")->fetchAll();
echo "Voila les serveurs de la table 3:<br>";
forEach($reqTable3 as $reqTab3){
  echo $reqTab3['name']."<br>";
}

// $reqLePlus= $db->query("SELECT e.name, SUM(oe.quantity) AS total 
// FROM `OrderEdible` AS oe 
// INNER JOIN `Edible` AS e 
// ON e.id = oe.idEdible
// GROUP BY oe.idEdible  
// HAVING total = (
//   SELECT SUM(oe.quantity) AS total 
//   FROM `OrderEdible` AS oe 
//   INNER JOIN `Edible` AS e 
//   ON e.id = oe.idEdible 
//   GROUP BY oe.idEdible 
//   ORDER BY total DESC LIMIT 1
// );")->fetch(PDO::FETCH_OBJ);
// echo "Le café le plus commandé est : " ;
// forEach($reqLePlus as $reqCafeMax){
//   echo $reqCafeMax["e.name"] ."<br>";
// }

$commandesServ2=$db->query(" SELECT createdAt AS Date,name AS wailter,FORMAT(SUM(price*quantity),2) AS price FROM `orderedible`,`order`,`waiter` WHERE orderedible.idOrder =`order`.id AND idWaiter = 2 AND idWaiter=waiter.id GROUP BY idOrder;")->fetchAll();
echo "Voila les commandes du serveur 2: <br><br>";

forEach($commandesServ2 as $commandeServ2){
  echo   "Serveur: " . $commandeServ2["wailter"] . "<br>" . "Total: " . $commandeServ2["price"] . "<br>" . Carbon::parse($commandeServ2["Date"])->locale('fr_FR')->diffForHumans() . "<br><br>";
}






?>









