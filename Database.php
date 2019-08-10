<?php
class Database
{
    private static $db;

    public static function connect()
    {      
        if (null === self::$db) 
        {
            try{
                self::$db = new PDO('mysql:host=localhost;dbname=superheroes;charset=UTF8','root','',[PDO::ATTR_ERRMODE=> PDO::ERRMODE_WARNING]);
                // Activer les erreurs MySQL
            }
            catch (Exception $e){
                die('Erreur : ' . $e->getMessage());
            }
            
        }
        return self::$db;
    }
}
?>