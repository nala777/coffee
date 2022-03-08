<?php    

class Edible extends CoffeeOrm{
  public static function allData() {
    
    $pdo = self::dbCnx();
      $sqlQuery = 'SELECT id, name FROM edible';

      return $pdo->query($sqlQuery);
  }
  public static function find($id) {
    $pdo = self::dbCnx();

    $sqlQuery = 'SELECT id, name FROM edible WHERE id= :id';

    $req = $pdo->prepare($sqlQuery);
    $req->execute(array(':id' => $id));

    return new self($req->fetch());
  
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

  
    
}