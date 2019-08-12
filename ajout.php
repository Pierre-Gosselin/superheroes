<?php
require_once "config/autoload.php";
require_once "partials/header.php";

if( $_SERVER['REQUEST_METHOD'] === "POST"){
    $photo = isset($_FILES['photo']) ? $_FILES['photo']: null;
    // Pas d'erreur dans sur l'upload

    $upload = new Upload($photo);
    var_dump($upload);
    if ($upload != null)
    {
        $upload->handle('upload');
        echo '<img src="'.$upload->read().'">';
    }
}
?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="photo" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
require_once "partials/footer.php";