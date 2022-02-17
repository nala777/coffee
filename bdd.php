<?php

//host: mysql-69238-0.cloudclusters.net;
//Port: 10520
// ID: admin/Xqu0WA1I

function bdd(){

    try{
        $bdd = new PDO("mysql:dbname=coffee;host=mysql-69238-0.cloudclusters.net:1052","admin", "Xqu0WA1I");;
    }catch(PDOException $e){
        echo "Connexion impossible: " . $e->getMessage();
    }

    return $bdd;

}