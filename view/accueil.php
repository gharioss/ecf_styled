<div class="search_item">
    <div class="search_navbar">
        <form action="index.php?controller=articles&task=specificSearch" method="POST">
            <input class="input_search" type="text" name="searchValue" placeholder="Rechercher un auteur ou un titre..." style="width:300px;">
            <button name="search" class="search_btn">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
</div>
<div class="research_items">


    <fieldset>
        <legend>Rechercher par auteur : </legend>
        <div class="custom-select">
            <form action="index.php?controller=articles&task=specificSearch" method="POST">
                <select id="category" name="id_autheur" style="width:220px;">
                    <?php foreach ($autheurs as $autheur) : ?>
                        <option value="<?= $autheur['fname']; ?>"><?= $autheur['fname'] . ' ' . $autheur['lname']; ?></option>
                    <?php endforeach; ?>
                </select>
                <button name="search" class="search_btn">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </fieldset>

    <fieldset>
        <legend>Rechercher par collection : </legend>
        <div>
            <form action="index.php?controller=articles&task=specificSearch" method="POST">
                <select id="category" name="id_collection" style="width:220px;">
                    <?php foreach ($autheurs as $autheur) : ?>
                        <option value="<?= $autheur['collection']; ?>"><?= $autheur['collection']; ?></option>
                    <?php endforeach; ?>
                </select>
                <button name="search" class="search_btn">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </fieldset>

    <fieldset>
        <legend>Rechercher par edition : </legend>
        <div>
            <form action="index.php?controller=articles&task=specificSearch" method="POST">
                <select id="category" name="id_edition" style="width:220px;">
                    <?php foreach ($autheurs as $autheur) : ?>
                        <option value="<?= $autheur['edition']; ?>"><?= $autheur['edition']; ?></option>
                    <?php endforeach; ?>
                </select>
                <button name="search" class="search_btn">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </fieldset>



    <fieldset>
        <legend>Rechercher par catégorie : </legend>
        <div>
            <form action="index.php?controller=articles&task=specificSearch" method="POST">
                <select id="category" name="id_category" style="width:220px;">
                    <?php foreach ($categorys as $category) : ?>
                        <option value="<?= $category['id_category']; ?>"><?= $category['category_name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <button name="search" class="search_btn">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </fieldset>



    <fieldset>
        <legend>Rechercher par genre : </legend>
        <div>
            <form action="index.php?controller=articles&task=specificSearch" method="POST">
                <select id="category" name="id_tags" style="width:220px;">
                    <?php foreach ($allTags as $tags) : ?>
                        <option value="<?= $tags['id_tags']; ?>"><?= $tags['tags']; ?></option>
                    <?php endforeach; ?>
                </select>
                <button name="search" class="search_btn">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </fieldset>
</div>



<div class="card_title">
    <h1>Roman</h1>
</div>
<ul class="card_lst">
    <?php for ($i = 0; $i <= 5; $i++) : ?>
        <?php if ($articles[$i]['id_category'] === "4") : ?>
            <li>
                <div class="card_flipper">
                    <a class="card_item" href="index.php?controller=articles&task=show&id=<?= $articles[$i]['id_article']; ?>">
                        <div class="card_front">

                            <img src="<?= $articles[$i]['img'] ?>" />
                            <div class="info card_title">
                            </div>
                        </div>
                        <div class="card_back">
                            <div class="info back_info">
                                <h3 class="subj"> <?= $articles[$i]['title']; ?></h3>
                                <p class="line"></p>
                                <p class="author"><?= $articles[$i]['fname'] . ' ' . $articles[$i]['lname']; ?></p>
                                <p class="line"></p>
                                <p class="summary">
                                    <?= $articles[$i]['content']; ?>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </li>
        <?php endif; ?>
    <?php endfor; ?>
</ul>

<hr class="header_main">

<div class="card_title">
    <h1>Manga</h1>
</div>
<ul class="card_lst">
    <?php for ($i = 0; $i <= 5; $i++) : ?>
        <?php if ($articles[$i]['id_category'] === "7") : ?>
            <li>
                <div class="card_flipper">
                    <a class="card_item" href="index.php?controller=articles&task=show&id=<?= $articles[$i]['id_article']; ?>">
                        <div class="card_front">

                            <img src="<?= $articles[$i]['img'] ?>" />
                            <div class="info card_title">
                            </div>
                        </div>
                        <div class="card_back">
                            <div class="info back_info">
                                <h3 class="subj"> <?= $articles[$i]['title']; ?></h3>
                                <p class="line"></p>
                                <p class="author"><?= $articles[$i]['fname'] . ' ' . $articles[$i]['lname']; ?></p>
                                <p class="line"></p>
                                <p class="summary">
                                    <?= $articles[$i]['content']; ?>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </li>
        <?php endif; ?>
    <?php endfor; ?>
</ul>