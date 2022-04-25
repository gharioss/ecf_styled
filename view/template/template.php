<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/f00c55aea5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <title><?= $pageTitle ?></title>
</head>

<body>
    <header>
        <nav class="top_navbar">
            <ul>
                <li>
                    <img src="pics/logo4.png" alt="" class="logo" />
                </li>

                <hr class="navbar_hr">
                <li>
                    <a class="navbar_bibli bold" href="index.php">Bibliothèque</a>
                </li>
                <hr class="navbar_hr">
                <!-- <div class="icons_navbar">
                    <li>
                        <span><i class="fa-brands fa-facebook"></i></span>
                    </li>
                    <li>
                        <span><i class="fa-brands fa-twitter"></i></span>
                    </li>
                </div> -->
                <!-- class="search-input" -->


                <div class="user_navbar">
                    <?php
                    if (!isset($_SESSION)) {
                        session_start();
                    }
                    if (!isset($_SESSION['is_logged'])) : ?>
                        <li>
                            <div class="signup_navbar first_li bold" id="signup">
                                S'inscrire
                            </div>
                        </li>
                    <?php else : ?>

                        <div class="navbar_li">
                            <li>
                                <?php if (!isset($_SESSION)) {
                                    session_start();
                                }
                                if ($_SESSION['is_admin'] == "1") : ?>
                                    <a class="first_li bold" href="index.php?controller=user&task=showUsers">
                                        Admin
                                    </a>
                            </li>
                            <li>
                            <?php endif; ?>
                            <a class="first_li bold" href="index.php?controller=pret&task=availableIndex">
                                Mon compte
                            </a>
                            </li>
                            <li>
                                <a class="first_li bold" href="index.php?controller=user&task=logout" onclick="return window.confirm('Êtes vous sûr de vouloir vous déconnecter ?')">
                                    Se déconnecter
                                </a>

                            </li>
                        </div>
                    <?php endif; ?>

                </div>
            </ul>
        </nav>
    </header>
    <hr class="header_main">
    <main>

        <div id="form_signup">
            <div class="wrapper">
                <section class="form signup">
                    <!-- enctype="multipart/form-data" -->
                    <form action="index.php?controller=user&task=insert" method="POST">
                        <div id="register_error" class="error-txt"></div>
                        <div class="name-details">
                            <div class="field input">
                                <label>Prénom</label>
                                <input id="register_fname" type="text" name="fname" placeholder="Prénom" required>
                            </div>
                            <div class="field input">
                                <label>Nom</label>
                                <input id="register_lname" type="text" name="lname" placeholder="Nom" required>
                            </div>
                        </div>
                        <div class="field input">
                            <label>Adresse email</label>
                            <input id="register_email" type="text" name="email" placeholder="Entrer votre email" required>
                        </div>
                        <div class="field input">
                            <label>Mot de passe</label>
                            <input id="register_password" type="password" name="password" placeholder="Entrez votre mot de passe" required>
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="field input">
                            <label>Adresse</label>
                            <input id="register_adress" type="text" name="adress" placeholder="Votre adresse" required>
                        </div>
                        <div class="name-details">
                            <div class="field input">
                                <label>Ville</label>
                                <input id="register_city" type="text" name="city" placeholder="Ville" required>
                            </div>
                            <div class="field input">
                                <label>Code postal</label>
                                <input id="register_zip_code" type="text" name="zip_code" placeholder="Code postal" required>
                            </div>
                        </div>
                        <div class="field button">
                            <input class="register_btn" type="submit" value="S'inscrire">
                        </div>
                    </form>
                    <div id="login" class="link">Déjà inscrit ? <span class="authentification">Se connecter</span></div>
                </section>
            </div>
        </div>



        <div id="form_login">
            <div class="wrapper">
                <section class="form signup">
                    <form action="index.php?controller=user&task=login" method="POST">
                        <div id="login_error" class="error-txt"></div>
                        <div class="field input">
                            <label>Adresse email</label>
                            <input type="text" name="email" placeholder="Entrer votre email" required>
                        </div>
                        <div class="field input">
                            <label>Mot de passe</label>
                            <input type="password" name="password" placeholder="Entrez votre mot de passe" required>
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="field button">
                            <input class="login_btn" type="submit" value="Se connecter">
                        </div>
                    </form>
                    <div id="register" class="link">Déjà inscrit ? <span class="authentification">S'inscrire</span></div>
                </section>
            </div>
        </div>
        <div class="content">
            <?= $pageContent ?>
        </div>

    </main>

    <script src="javascript/sign_up.js"></script>

    <script>
        document.getElementById("signup").addEventListener('click', event => {
            // toogle permet de voir si la classe est active alors il l'enlève sinon il le mets
            document.getElementById("form_signup").classList.toggle("active")
        })

        document.getElementById('login').addEventListener('click', event => {
            document.getElementById("form_signup").classList.remove("active")
            document.getElementById("form_login").classList.toggle("active")
        })
        document.getElementById('register').addEventListener('click', event => {
            document.getElementById("form_signup").classList.toggle("active")
            document.getElementById("form_login").classList.remove("active")
        })

        const pswrdField = document.querySelector(".form input[type='password']"),
            toggleBtn = document.querySelector(".form .field i ");

        toggleBtn.onclick = () => {
            if (pswrdField.type == "password") {
                pswrdField.type = "text";
                toggleBtn.classList.add("active");
            } else {
                pswrdField.type = "password";
                toggleBtn.classList.remove("active");
            }
        }
    </script>
</body>

</html>