<?php
include_once "partials/header.php";
require_once "config/autoload.php";

$id = isset($_GET['id']) ? trim($_GET['id']) : null;

$name = null;
$power = null;
$identity = null;
$universes = ['Marvel','DC'];

if (ctype_digit($id))
{
    $id = $_GET['id'];
    $db = Database::connect();

    $sql = "SELECT * FROM `superheroe` WHERE `id`=:id";
    // Execution de la requete
    $query = $db->prepare($sql);

    $query->bindValue(':id',$id, PDO::PARAM_INT);

    $query->execute();

    $query->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, SuperHeroe::class);
    // Recupération des résultats
    $superheroes = $query->fetch();

    if (!$superheroes)
    {
        header('location:read.php');
    }

    $name = $superheroes->name();
    $power = $superheroes->power();
    $identity = $superheroes->identity();
    $universe = $superheroes->universe();
}


if( $_SERVER['REQUEST_METHOD'] === "POST"){
    // 1. Initialisation des erreurs
    $errors = [];

    // 2. Récupération des données
    $name = isset($_POST['name']) ? trim(htmlentities($_POST['name'])): null;
    $power = isset($_POST['power']) ? trim(htmlentities($_POST['power'])): null;
    $identity = isset($_POST['identity']) ? trim(htmlentities($_POST['identity'])): null;
    $universe = isset($_POST['universe']) ? trim(htmlentities($_POST['universe'])): null;

    // 3. Vérification des données
    if (strlen($name)<2)
    {
        $errors['name'] = "name doit être d'au moins 2 caractères";
    }

    if (strlen($power)<2)
    {
        $errors['power'] = "power doit être d'au moins 2 caractères";
    }

    if (strlen($identity)<2)
    {
        $errors['identity'] = "identity doit être d'au moins 2 caractères";
    }

    if (strlen($universe)<2)
    {
        $errors['universe'] = "universe doit être d'au moins 2 caractères";
    }

    if (empty($errors))
    {

        $superheroes->hydrate($_POST);
        $superheroes->update($id);    

        // Redirection de l'utilisateur vers la page de détail du film
        header("location: read.php");
        exit;
    }
}
?>

<h1>Modification un superhéros</h1>
<form method="POST">
    <?php
        include_once "form.php";
    ?>
    <button class="btn btn-primary">Modifier</button>
</form>

<?php 
include_once "partials/footer.php"; 
?>