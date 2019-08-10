
<?php
require_once "partials/header.php";
require_once "config/autoload.php";

$name = null;
$power = null;
$identity = null;
$universe = null;
$universes = ['Marvel','DC'];


if ($_SERVER['REQUEST_METHOD'] === "POST")
{
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
        $heroe = new SuperHeroe();
        $heroe->hydrate($_POST);
        
        if ($heroe->create())
        {
            header('Location: read.php'); 
        }
    }
}
?>

<h1>Ajouter un superhéros</h1>
<form method="POST">
    <?php
        require_once "form.php";
    ?>
    <button class="btn btn-primary">Ajouter</button>
</form>

<?php require_once "partials/footer.php"; ?>