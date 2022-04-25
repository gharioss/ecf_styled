<?php

namespace Controllers;

class Articles extends Controller
{

    public function index()
    {
        $articleClass = new \Models\Articles();

        $article_genreClass = new \Models\Tags();

        $pretClass = new \Models\Pret();


        $articles = $articleClass->findAll();

        $autheurs = $articleClass->getAutheur();

        $categorys = $articleClass->getCategory();

        $allTags = $article_genreClass->selectTags();

        $emprunt = $pretClass->getAvailable();


        $pageTitle = "Articles";


        $this->render('accueil', compact('pageTitle', 'articles', 'autheurs', 'categorys', 'allTags', 'emprunt'));
    }

    public function show()
    {
        $articleClass = new \Models\Articles();

        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $article_id = $_GET['id'];
        }

        if (!$article_id) {
            die("Il y a eu une erreur");
        }

        $article = $articleClass->details($article_id);

        $pageTitle = "Article";

        $this->render('article/article', compact('pageTitle', 'article'));
    }

    public function getBook()
    {
        $articleClass = new \Models\Articles();

        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $article_id = $_GET['id'];
        }

        if (!$article_id) {
            die("Il y a eu une erreur");
        }

        $article = $articleClass->update($article_id);

        $this->redirect('index.php');
    }


    public function showAdd()
    {

        $pageTitle = "Ajouter un article";

        $this->render('admin/addBook', compact('pageTitle'));
    }


    public function addRecipe()
    {

        $articleClass = new \Models\Articles();

        $fname = null;
        $lname = null;
        $genre = null;
        $title = null;
        $dir = $_SERVER['DOCUMENT_ROOT'] . '/pics/';
        $pic_path = $dir . basename($_FILES['add_image']['name']);
        $content = null;
        $id_category = null;
        $collection = null;
        $edition = null;

        $checkbox1 = null;

        if (!empty($_POST['add_fname']) && !empty($_POST['add_lname']) && !empty($_POST['add_title']) && !empty($_POST['add_contenu']) && !empty($_POST['add_category']) && !empty($_POST['add_collection']) && !empty($_POST['add_edition'])) {

            if (move_uploaded_file($_FILES['add_image']['tmp_name'], $pic_path)) {

                $fname = $_POST['add_fname'];
                $lname = $_POST['add_lname'];
                $title = $_POST['add_title'];
                $img = "pics/" . $_FILES['add_image']['name'];
                $content = $_POST['add_contenu'];
                $id_category = $_POST['add_category'];
                $collection = $_POST['add_collection'];
                $edition = $_POST['add_collection'];


                $articleClass->insertRecipe($fname, $lname, $title, $img, $content, $id_category, $collection, $edition);


                $this->redirect('index.php?controller=tags&task=showTags');
            }
        } else {
            echo "Vous devez remplir toutes les données.";
        }
    }

    public function getAllArticle()
    {

        $articleClass = new \Models\Articles();


        $articles = $articleClass->getAll();


        $pageTitle = "Tous les articles";


        $this->render('admin/listBook', compact('pageTitle', 'articles'));
    }


    public function deleteArticle()
    {
        $articleClass = new \Models\Articles();

        if ($_GET['id']) {
            $id = $_GET['id'];
        }

        if (!$id) {
            echo "il y a eu une erreur";
        }

        $usersInfo = $articleClass->delete($id);

        $this->redirect('index.php?controller=articles&task=getAllArticle');
    }

    public function editArticle()
    {
        $articleClass = new \Models\Articles();

        if ($_GET['id']) {
            $id = $_GET['id'];
        }

        if (!$id) {
            echo "il y a eu une erreur";
        }

        $usersInfo = $articleClass->edit($id);

        $this->redirect('index.php?controller=articles&task=getAllArticle');
    }

    public function detailArticle()
    {
        $articleClass = new \Models\Articles();

        $article_genreClass = new \Models\Tags();


        if ($_GET['id']) {
            $id = $_GET['id'];
        }

        if (!$id) {
            echo "il y a eu une erreur";
        }

        $detailArticles = $articleClass->getAllAndTags($id);

        $allTags = $article_genreClass->selectTags();

        $pageTitle = "Article";

        $this->render('admin/detailArticle', compact('pageTitle', 'allTags', 'detailArticles'));
    }




    public function editThisArticle()
    {

        $articleClass = new \Models\Articles();

        if ($_GET['id']) {
            $id = $_GET['id'];
        }

        if (!$id) {
            echo "il y a eu une erreur";
        }

        $fname = null;
        $lname = null;
        $title = null;
        $content = null;
        $collection = null;
        $edition = null;

        if (!empty($_POST['article_edit_title']) && !empty($_POST['article_edit_lname']) && !empty($_POST['article_edit_fname']) && !empty($_POST['article_edit_content']) && !empty($_POST['article_edit_edition']) && !empty($_POST['article_edit_collection'])) {

            $fname = $_POST['article_edit_fname'];
            $lname = $_POST['article_edit_lname'];
            $title = $_POST['article_edit_title'];
            $content = $_POST['article_edit_content'];
            $collection = $_POST['article_edit_collection'];
            $edition = $_POST['article_edit_edition'];


            $articleClass->fullEdit($fname, $lname, $title, $content, $collection, $edition, $id);

            $this->redirect('index.php?controller=articles&task=getAllArticle');
        }
        echo "there was a pb";
    }


    public function specificSearch()
    {
        $articleClass = new \Models\Articles();

        $article_genreClass = new \Models\Tags();

        $search = null;

        if (isset($_POST['id_autheur'])) {
            $search = $_POST['id_autheur'];

            $thisSearch = $articleClass->searchAutheur($search);
        } elseif (isset($_POST['id_collection'])) {
            $search = $_POST['id_collection'];

            $thisSearch = $articleClass->searchCollection($search);
        } elseif (isset($_POST['id_edition'])) {
            $search = $_POST['id_edition'];

            $thisSearch = $articleClass->searchEdition($search);
        } elseif (isset($_POST['id_category'])) {
            $search = $_POST['id_category'];

            $thisSearch = $articleClass->searchCategory($search);
        } elseif (isset($_POST['id_tags'])) {
            $search = $_POST['id_tags'];

            $thisSearch = $articleClass->searchTags($search);
        } elseif (isset($_POST['searchValue'])) {
            $search = $_POST['searchValue'];


            $thisSearch = $articleClass->getSearch($search);
        }

        $pageTitle = "Search";



        $autheurs = $articleClass->getAutheur();

        $categorys = $articleClass->getCategory();

        $allTags = $article_genreClass->selectTags();


        $this->render('article/search', compact('pageTitle', 'thisSearch', 'autheurs', 'categorys', 'allTags'));
    }
}
