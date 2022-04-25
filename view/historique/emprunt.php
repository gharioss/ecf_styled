<?php include "view/account.php"; ?>

<ul class="card_lst">
    <?php foreach ($emprunt as $e) : ?>
        <li>
            <div class="card_flipper">
                <a class="card_item" href="index.php?controller=articles&task=show&id=<?= $e['id_article']; ?>">
                    <div class="card_front">

                        <img src="<?= $e['img'] ?>" />
                        <div class="info card_title">
                        </div>
                    </div>
                    <div class="card_back">
                        <div class="info back_info">
                            <h3 class="subj"> <?= $e['title']; ?></h3>
                            <p class="line"></p>
                            <p class="author"><?= $e['fname'] . ' ' . $e['lname']; ?></p>
                            <p class="line"></p>
                            <p class="summary">
                                <?= $e['status']; ?>
                            </p>
                            <p class="line"></p>
                            <a class="render_book" href="index.php?controller=pret&task=returnThis&id=<?= $e['id_article']; ?>" onclick="return window.confirm('Êtes vous sûr de vouloir rendre ce livre ?')">Rendre ce livre ?</a>
                        </div>
                    </div>
                </a>
            </div>
        </li>
    <?php endforeach; ?>
</ul>