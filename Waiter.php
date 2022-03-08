<?php    

class Waiter extends CoffeeOrm {
  public static function allData() {
    
      $pdo = self::dbCnx();
      $sqlQuery = 'SELECT id, name FROM Waiter';

      return $pdo->query($sqlQuery);
  }
    
  private $id;
  private $name;
    
  public function __construct($data) {
    $this->id = $data["id"];
    $this->name = $data["name"];
  }
    
  public function getName() {    
    return $this->name;
  }

  public function getFormatedName() {
    return ucwords($this->name) . " | id : " . $this->id;
  }
}