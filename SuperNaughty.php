<?php


class SuperNaughty
{
    private $name;
    private $identity;
    private $hobby;
    private $universe;

    //setters
    public function name()
    {
        return $this->name;
    }
    public function identity()
    {
        return $this->identity;
    }
    public function hobby()
    {
        return $this->hobby;
    }
    public function universe()
    {
        return $this->universe;
    }

    //getters
    public function setName($name)
    {
        $this->name = trim($name);
    }
    public function setIdentity($identity)
    {
        $this->identity = trim($identity);
    }
    public function setHobby($hobby)
    {
        $this->hobby = trim($hobby);
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
    }

    public function create()
    {
        $db = Database::connect();

        $sql = "INSERT INTO `supernaughty` (`name`, `identity`, `hobby`,`universe`) VALUES (:name,:identity,:hobby,:universe)";

        $query = $db->prepare($sql);

        $query->bindValue(':name',$this->name());
        $query->bindValue(':hobby',$this->hobby());
        $query->bindValue(':identity',$this->identity());
        $query->bindValue(':universe',$this->universe());

        return $query->execute();
    }

    public function delete($id)
    {
        $db = Database::connect();

        $sql = "DELETE FROM `supernaughty` WHERE id=:id";

        $query = $db->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);

        $query->execute();
    }

    public function update($id)
    {
        $db = Database::connect();
        $sql = "UPDATE `supernaughty` SET `name`=:name, `hobby`=:hobby, `identity`=:identity, `universe`=:universe WHERE `id`=:id";
        
        $query = $db->prepare($sql);
        
        $query->bindValue(':id',$id, PDO::PARAM_INT);
        $query->bindValue(':name',$this->name());
        $query->bindValue(':hobby',$this->hobby());
        $query->bindValue(':identity',$this->identity());
        $query->bindValue(':universe',$this->universe());

        $query->execute();
    }

    public static function findAll()
    {
        $query = Database::connect()->query('SELECT * FROM `supernaughty`');
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}