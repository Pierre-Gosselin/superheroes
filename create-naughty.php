<?php

require_once "config/autoload.php";
require_once "partials/header.php";

if ($_SERVER['REQUEST_METHOD'] === "POST")
{
    $name = isset($_POST['name'])? trim(htmlentities(($_POST['name']))): null;
    $hobby = isset($_POST['hobby'])? trim(htmlentities(($_POST['hobby']))): null;
    $identity = isset($_POST['identity'])? trim(htmlentities(($_POST['identity']))): null;
    $universe = isset($_POST['universe'])? trim(htmlentities(($_POST['universe']))): null;

    $supernaughty = new SuperNaughty($_POST);
    $supernaughty->create();

    header('location:read-naughty.php');
}

?>
<h1>Ajouter un super vilain</h1>
<form method="POST">
<div class="form-group">
    <label for="name">Name :</label>
    <input type="text" class="form-control" id="name" name="name">
</div>
<div class="form-group">
    <label for="hobby">Hobby :</label>
    <input type="text" class="form-control" id="hobby" name="hobby">
</div>            
<div class="form-group">
    <label for="identity">Identity :</label>
    <input type="text" class="form-control" id="identity" name="identity">
</div>

<div class="form-group">
    <label for="universe">Universe :</label>
    <select class="form-control" id="universe" name="universe">
        <option value="Marvel">Marvel</option>
        <option value="DC">DC</option>
    </select>
</div>
<button class="btn btn-primary">Ajouter</button>
</form>

<?php
require_once "partials/footer.php";
