<?php 

//PDO = php data object

function bdd(){

    try{
        $bdd = new PDO("mysql:dbname=abclight;host=localhost", "root", "");
    }catch(PDOException $e){
        echo "Connexion impossible: " . $e->getMessage();
    }

    return $bdd;

}
