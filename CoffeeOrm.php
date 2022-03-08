<?php

class CoffeeOrm{
    protected static function dbCnx()
    {

        try {
            $path = "mysql:host=".$_ENV['DB_HOST'].":".$_ENV['DB_PORT'].";dbname=".$_ENV['DB_NAME'].";charset=utf8";

            $pdo = new PDO(
            $path, 
            $_ENV['DB_USERNAME'], 
            $_ENV['DB_PASSWORD']
            );
            return $pdo;
        }   catch (Exception $e) {

            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function all() {
        $objects = [];
    
        $child = get_called_class();
    
        $sqlQuery = "SELECT * FROM `{$child}`";
    
        foreach (self::dbCnx()->query($sqlQuery) as $data) {
          array_push(
            $objects, 
            new $child($data)
          );
        }
        
        return $objects;
      }
}