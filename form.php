<div class="form-group">
    <label for="name">Name :</label>
    <input type="text" class="form-control" id="name" name="name" value="<?= $name ?>">
</div>
<div class="form-group">
    <label for="power">Power :</label>
    <input type="text" class="form-control" id="power" name="power" value="<?= $power ?>">
</div>            
<div class="form-group">
    <label for="identity">Identity :</label>
    <input type="text" class="form-control" id="identity" name="identity" value="<?= $identity ?>">
</div>

<div class="form-group">
    <label for="universe">Universe :</label>
    <select class="form-control" id="universe" name="universe">
        <?php foreach ($universes as $universe_selec) : ?>
            <option value="<?= $universe_selec ?>" <?= ($universe_selec == $universe ? "selected": null)?> ><?= $universe_selec ?></option>
        <?php endforeach ; ?>
    </select>
</div>