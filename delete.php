<?php
include_once "partials/header.php";
require_once "config/autoload.php";

$id = isset($_GET['id'])? trim($_GET['id']): null;

if (ctype_digit($id))
{
    $superheroe = SuperHeroe::find($id);
    if (!$superheroe){
        header('location:read.php');
    }
}
else
{
    header('location:read.php');
}

if ($_SERVER['REQUEST_METHOD'] === "POST")
{
    $superheroe = new SuperHeroe($superheroe);
    $superheroe->delete($id);
    header("location: read.php");
    exit;
}
?>

<h1>Suppresion de <?= $superheroe->name(); ?></h1>

<p>Confirmer la suppression du héros : "<?= $superheroe->name()." (id:".$id.")"; ?>"</p>
<p>Power : <?= $superheroe->power(); ?></p>
<p>Identity : <?= $superheroe->identity(); ?></p>
<p>Universe : <?= $superheroe->universe(); ?></p>

<div class="row justify-content-center">
    <div class="col-2">
        <form method="post">
            <button class="btn btn-danger" type="submit">OUI</button>
        </form>
    </div>
    <div class="col-2">
        <a class="btn btn-primary" href="read.php">NON</a>
    </div>
</div>
<?php 
include_once "partials/footer.php"; 
?>