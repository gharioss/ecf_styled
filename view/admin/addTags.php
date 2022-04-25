<form method="POST" action="index.php?controller=article_genre&task=insertTags">
    <div class="contact-input">

        <div class="add-titre">
            <fieldset>
                <legend>Choisissez les tags : </legend>

                <div>

                    <?php foreach ($allTags as $tags) : ?>
                        <input type="checkbox" name="chkl[ ]" value="<?= $tags['id_tags']; ?>">
                        <label for="scales"><?= $tags['tags']; ?></label>

                    <?php endforeach; ?>

                </div>

            </fieldset>
        </div>
        <div class="field button">
            <input name="add_book" type="submit" value="Ajouter ces tags" onclick="return window.confirm('Êtes vous sûr de vouloir ajouter ces tags ?')">
        </div>
    </div>
</form>