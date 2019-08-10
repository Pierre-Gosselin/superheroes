<?php

/**
 * Créer une classe SuperHeroe avec les attributs name, power, identity, universe
 */
require_once "SuperHeroe.php";
//1. Connexion à la BD
require_once "config\dbconnect.php";

$ironMan = new SuperHeroe();
$ironMan->name = 'Iron Man';
$ironMan->power = 'Riche';
$ironMan->identity = 'Tony Stark';
$ironMan->universe = 'Marvel';

$captainAmerica = new SuperHeroe('Captain America', 'Force', 'Steve Rogers', 'Marvel');
$hulk = new SuperHeroe('Hulk', 'Force', 'Bruce Banner', 'Marvel');
$batman = new SuperHeroe('Batman', 'Riche', 'Bruce Wayne', 'DC');

echo $hulk->getRealIdentity();
echo $hulk->getUniverse();


$heroes = [$ironMan, $captainAmerica, $hulk, $batman];
var_dump($heroes);


$sql = "INSERT INTO `superheroe` (`name`, `power`, `identity`,`universe`) VALUES (:name,:power,:identity,:universe)";

// Préparation de la requête
$query = $db->prepare($sql);

$query->bindValue(':name',$ironMan->name);
$query->bindValue(':power',$ironMan->power);
$query->bindValue(':identity',$ironMan->identity);
$query->bindValues(':universe',$ironMan->universe);

$query->execute();


SuperHeroe::All();
/**
 * Créer la base de données : superheroes
 * créer la table superheroe
 * créer les colonnes: name, power, identity, universe en VARCHAR
 */