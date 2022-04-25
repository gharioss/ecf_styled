<?php include('view/admin/redirect.php'); ?>

<div class="card_title">
    <h1>Listes des livres empruntés</h1>
</div>
<div class="field button">
    <a href="index.php?controller=user&task=showUsers">
        <input type="submit" value="retour">
    </a>
</div>
<article class="historique">
    <?php foreach ($emprunt as $e) :  ?>
        <div class="list_historique">
            <a href="index.php?controller=articles&task=show&id=<?= $e['id_article']; ?>">
                <img src="<?= $e['img'] ?>" />
                <p><?= $e['status']; ?></p>
            </a>
        </div>
    <?php endforeach; ?>
</article>