<?php
include_once "partials/header.php";
require_once "config/autoload.php";

$id = isset($_GET['id'])? trim($_GET['id']): null;

if (ctype_digit($id))
{
    $id = $_GET['id'];
    $db = Database::connect();

    $sql = "SELECT * FROM `supernaughty` WHERE `id`=:id";

    $query = $db->prepare($sql);
    $query->bindValue(':id',$id, PDO::PARAM_INT);
    $query->execute();

    $supernaughty = $query->fetch(PDO::FETCH_OBJ);

    if (!$supernaughty){
        header('location:read-naughty.php');
    }
}

if ($_SERVER['REQUEST_METHOD'] === "POST")
{
    $supernaughty = new SuperNaughty($supernaughty);
    $supernaughty->delete($id);

    header("location: read-naughty.php");
    exit;
}
?>

<h1>Suppresion de <?= $supernaughty->name?></h1>

<p>Confirmer la suppression du vilain : "<?= $supernaughty->name ?>"</p>
<div class="row justify-content-center">
    <div class="col-2">
        <form method="post">
            <button class="btn btn-danger" type="submit">OUI</button>
        </form>
    </div>
    <div class="col-2">
        <a class="btn btn-primary" href="read-naughty.php">NON</a>
    </div>
</div>
<?php 
include_once "partials/footer.php"; 
?>