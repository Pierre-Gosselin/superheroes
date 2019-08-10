<?php
require_once "config/autoload.php";
require_once "partials/header.php";

// Remplissage des deux champs select
$superheroes = SuperHeroe::findAll();
$supernaughtys = SuperNaughty::findAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $superheroe = isset($_POST['superheroe'])? trim($_POST['superheroe']): null;
    $supernaughty = isset($_POST['supernaughty'])? trim($_POST['supernaughty']): null;

    $sql = "INSERT INTO `superheroe_has_supernaughty` (`superheroe_id`, `supernaughty_id`) VALUES (:superheroe_id, :supernaughty_id)";

    $query = Database::connect()->prepare($sql);

    $query->bindValue(':superheroe_id',$superheroe,PDO::PARAM_INT);
    $query->bindValue(':supernaughty_id',$supernaughty,PDO::PARAM_INT);

    $query->execute();
    header('location:read.php');
}
?>
<form method="POST">
<div class="form-group">
    <label for="superheroe">Super héro :</label>
    <select class="form-control" id="superheroe" name="superheroe">
        <?php foreach ($superheroes as $superheroe): ?>
            <option value="<?= $superheroe->id?>"><?=$superheroe->name?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="form-group">
    <label for="supernaughty">Super vilain :</label>
    <select class="form-control" id="supernaughty" name="supernaughty">
        <?php foreach ($supernaughtys as $supernaughty): ?>
            <option value="<?= $supernaughty->id?>"><?=$supernaughty->name?></option>
        <?php endforeach; ?>
    </select>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
require_once "partials/footer.php";