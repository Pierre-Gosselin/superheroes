<?php
include_once "partials/header.php";
require_once "config/autoload.php";


$id = isset($_GET['id'])? trim($_GET['id']): null;

if (ctype_digit($id))
{
    $db = Database::connect();

    $sql = "SELECT * FROM `supernaughty` WHERE `id`=:id";
    $query = $db->prepare($sql);

    $query->bindValue(':id',$id, PDO::PARAM_INT);

    $query->execute();

    $query->setFetchMode(PDO::FETCH_CLASS, SuperNaughty::class);

    $supernaughty = $query->fetch();

    if (!$supernaughty)
    {
        header('location:read-naughty.php');
    }
}

if ($_SERVER['REQUEST_METHOD'] === "POST")
{
    $supernaughty = new SuperNaughty($_POST);
    $supernaughty->update($id);

    header('location:read-naughty.php');
}


?>

<h1>Modifier un super vilain</h1>
<form method="POST">
<div class="form-group">
    <label for="name">Name :</label>
    <input type="text" class="form-control" id="name" name="name" value="<?= $supernaughty->name() ?>">
</div>
<div class="form-group">
    <label for="hobby">Hobby :</label>
    <input type="text" class="form-control" id="hobby" name="hobby" value="<?= $supernaughty->hobby() ?>">
</div>            
<div class="form-group">
    <label for="identity">Identity :</label>
    <input type="text" class="form-control" id="identity" name="identity" value="<?= $supernaughty->identity() ?>">
</div>

<div class="form-group">
    <label for="universe">Universe :</label>
    <select class="form-control" id="universe" name="universe">
        <option value="Marvel" <?= ($supernaughty->universe() === "Marvel")? "selected": null; ?>>Marvel</option>
        <option value="DC" <?= ($supernaughty->universe() === "DC")? "selected": null; ?>>DC</option>
    </select>
</div>
<button class="btn btn-primary">Modifier</button>
</form>

<?php 
include_once "partials/footer.php"; 
?>