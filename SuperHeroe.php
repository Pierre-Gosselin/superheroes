<?php

class SuperHeroe
{
    private $name;
    private $power;
    private $identity;
    private $universe;
    public static $tabHeroe;

    //getters
    public function name()
    {
        return $this->name;
    }
    public function identity()
    {
        return $this->identity;
    }
    public function power()
    {
        return $this->power;
    }
    public function universe()
    {
        return $this->universe;
    }

    //setters
    public function setName($name)
    {
        $this->name = trim($name);
    }
    public function setIdentity($identity)
    {
        $this->identity = trim($identity);
    }
    public function setPower($power)
    {
        $this->power = trim($power);
    }
    public function setUniverse($universe)
    {
        $this->universe = trim($universe);
    }

    public function hydrate($naughty)
    {
        foreach ($naughty as $key => $value)
        {
          $method = 'set'.ucfirst($key);
          
          if (method_exists($this, $method))
          {
            $this->$method($value);
          }
        }
    }

    public function __construct($donnees = [])
    {
        $this->hydrate($donnees);
    
        self::$tabHeroe[] = $this;

        // Si la base n'existe pas, on l'a créé ( A revoir )
        if (Database::connect()->exec('CREATE DATABASE IF NOT EXISTS superheroes')) {
            // On créé la base
            $db_create = "CREATE TABLE `supernaughty` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT, `name` VARCHAR(45), `power` VARCHAR(45), `identity` VARCHAR(45), `universe` VARCHAR(45), PRIMARY KEY (`id`))";
            $db->exec($db_create);
        }
    }

    public function getRealIdentity()
    {
        return "L'identité réelle de $this->name est $this->identity<br>";
    }

    public function getUniverse()
    {
        return "$this->name fait partie de l'univers $this->universe";
    }

    public static function All()
    {
        var_dump(self::$tabHeroe);
    }

    public function create()
    {
        $db = Database::connect();

        $sql = "INSERT INTO `superheroe` (`name`, `power`, `identity`,`universe`) VALUES (:name,:power,:identity,:universe)";

        $query = $db->prepare($sql);

        $query->bindValue(':name',$this->name());
        $query->bindValue(':power',$this->power());
        $query->bindValue(':identity',$this->identity());
        $query->bindValue(':universe',$this->universe());

        return $query->execute();
    }
    
    public function delete($id)
    {
        $db = Database::connect();

        $sql = "DELETE FROM `superheroe` WHERE id=:id";

        $query = $db->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);

        $query->execute();
    }

    public function update($id)
    {
        $db = Database::connect();
        $sql = "UPDATE `superheroe` SET `name`=:name, `power`=:power, `identity`=:identity, `universe`=:universe WHERE `id`=:id";
        
        $query = $db->prepare($sql);
        
        $query->bindValue(':id',$id, PDO::PARAM_INT);
        $query->bindValue(':name',$this->name());
        $query->bindValue(':power',$this->power());
        $query->bindValue(':identity',$this->identity());
        $query->bindValue(':universe',$this->universe());

        $query->execute();

    }
    public static function findAll($tri = "")
    {
        $tri ="ORDER BY `name` ASC";
        $query = Database::connect()->query('SELECT * FROM `superheroe`'.$tri);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    public static function find($id)
    {
        $query = Database::connect()->prepare('SELECT * FROM `superheroe` WHERE id = :id');
        $query->bindValue('id', $id);
        $query->execute();
        // Le setFetchMode ici permet de retourner une instance de SuperHeroe avec fetch plutôt qu'une instance de StdClass
        $query->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, SuperHeroe::class);
        return $query->fetch(PDO::FETCH_CLASS); // le fetch fait un new SuperHeroe(); grâce à PDO::FETCH_CLASS
    }
}