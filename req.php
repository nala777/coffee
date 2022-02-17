<?php 

//PDO = php data object

function bdd(){

    try{
        $bdd = new PDO("mysql:dbname=coffee;host=mysql-69238-0.cloudclusters.net:10520","admin", "Xqu0WA1I");;
    }catch(PDOException $e){
        echo "Connexion impossible: " . $e->getMessage();
    }

    return $bdd;

}
