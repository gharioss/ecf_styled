<?php

namespace Models;

class Articles extends Model
{
    protected $table = "articles";

    public function details($id)
    {
        $stmt1 = $this->pdo->prepare("SELECT * from {$this->table} WHERE id_article = :id_article");
        $stmt1->bindParam(':id_article', $id);
        $stmt1->execute();
        $article = $stmt1->fetch();

        return $article;
    }

    public function update($id)
    {
        $stmt1 = $this->pdo->prepare("UPDATE {$this->table} SET available = 0 WHERE id_article = :id_article");
        $stmt1->bindParam(':id_article', $id);
        $stmt1->execute();

        if (!isset($_SESSION)) {
            session_start();
        }
        $stmt2 = $this->pdo->prepare("INSERT INTO pret (id_user, available, date_got, date_release, id_article) VALUES (:id_user, 1, CURRENT_DATE(), DATE_ADD(CURRENT_DATE(), INTERVAL 7 DAY), :id_article)");
        $stmt2->bindParam(':id_user', $_SESSION['is_logged']);
        $stmt2->bindParam(':id_article', $id);
        $stmt2->execute();
    }


    public function getTags()
    {
        $stmt1 = $this->pdo->prepare("SELECT * from {$this->table} LEFT JOIN tags
                                    ON articles.id_tags = tags.id_tags
                                    ");
        // $stmt1->bindParam(':id_article', $id);
        $stmt1->execute();
        $article = $stmt1->fetchAll();

        return $article;
    }



    public function insertRecipe($fname, $lname, $title, $img, $content, $id_category, $genre, $collection, $edition)
    {
        $stmt2 = $this->pdo->prepare("INSERT INTO articles
                                    (fname, lname, title, img, content, date_put, id_category, id_tags, available, collection, edition)
                                    VALUES
                                    (:fname, :lname, :title, :img, :content, CURRENT_DATE(), :id_category, :id_tags, 1, :collection, :edition)");
        $stmt2->bindParam(':fname', $fname);
        $stmt2->bindParam(':lname', $lname);
        $stmt2->bindParam(':title', $title);
        $stmt2->bindParam(':img', $img);
        $stmt2->bindParam(':content', $content);
        $stmt2->bindParam(':id_category', $id_category);
        $stmt2->bindParam(':id_tags', $genre);
        $stmt2->bindParam(':collection', $collection);
        $stmt2->bindParam(':edition', $edition);
        $stmt2->execute();
    }

    public function getAll()
    {
        $sql = $this->pdo->query("SELECT * FROM {$this->table}
                                LEFT JOIN tags ON articles.id_tags = tags.id_tags
                                ORDER BY id_article DESC");
        $articles = $sql->fetchAll();

        return $articles;
    }

    public function delete($id)
    {
        $stmt1 = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id_article = :id_article");
        $stmt1->bindParam(":id_article", $id);
        $stmt1->execute();
    }

    public function edit($id)
    {
        $stmt1 = $this->pdo->prepare("UPDATE {$this->table} SET available = 0 WHERE id_article = :id_article");
        $stmt1->bindParam(':id_article', $id);
        $stmt1->execute();
    }

    public function getAllAndTags($id)
    {
        $stmt1 = $this->pdo->query("SELECT * FROM articles
                                    LEFT JOIN tags ON articles.id_tags = tags.id_tags
                                    WHERE articles.id_article = $id");
        $all = $stmt1->fetchAll();

        return $all;
    }
    public function fullEdit($fname, $lname, $title, $content, $collection, $edition, $id)
    {
        $stmt1 = $this->pdo->prepare("UPDATE {$this->table} SET fname = :fname, lname = :lname, title = :title, content = :content, collection = :collection, edition = :edition WHERE id_article = :id_article");
        $stmt1->bindParam(':fname', $fname);
        $stmt1->bindParam(':lname', $lname);
        $stmt1->bindParam(':title', $title);
        $stmt1->bindParam(':content', $content);
        $stmt1->bindParam(':collection', $collection);
        $stmt1->bindParam(':edition', $edition);
        $stmt1->bindParam(':id_article', $id);
        $stmt1->execute();
    }


    public function getAutheur()
    {
        $stmt1 = $this->pdo->prepare("SELECT DISTINCT fname, lname, edition, collection FROM {$this->table}");
        $stmt1->execute();

        $autheur = $stmt1->fetchAll();

        return $autheur;
    }

    public function getCategory()
    {
        $stmt1 = $this->pdo->prepare("SELECT DISTINCT category.id_category, category.category_name FROM {$this->table} LEFT JOIN category ON articles.id_category = category.id_category");
        $stmt1->execute();

        $autheur = $stmt1->fetchAll();

        return $autheur;
    }


    public function getSearch($search)
    {
        $sql = $this->pdo->query("SELECT * 
                                FROM articles
                                LEFT JOIN tags ON articles.id_tags = tags.id_tags
                                WHERE concat(fname,lname) LIKE '%{$search}%' OR title LIKE '%{$search}%'
                                ");
        $article = $sql->fetchAll();

        return $article;
    }


    public function searchAutheur($search)
    {
        $stmt1 = $this->pdo->prepare("SELECT * FROM {$this->table}
                                    LEFT JOIN tags ON articles.id_tags = tags.id_tags
                                    WHERE concat(fname,lname) LIKE '%{$search}%'");
        $stmt1->execute();

        $autheur = $stmt1->fetchAll();

        return $autheur;
    }


    public function searchCollection($search)
    {
        $stmt1 = $this->pdo->prepare("SELECT * FROM {$this->table}
                                     LEFT JOIN tags ON articles.id_tags = tags.id_tags
                                     WHERE collection LIKE '%{$search}%'");
        $stmt1->execute();

        $autheur = $stmt1->fetchAll();

        return $autheur;
    }


    public function searchEdition($search)
    {
        $stmt1 = $this->pdo->prepare("SELECT * FROM {$this->table}
                                    LEFT JOIN tags ON articles.id_tags = tags.id_tags
                                    WHERE edition LIKE '%{$search}%'");
        $stmt1->execute();

        $autheur = $stmt1->fetchAll();

        return $autheur;
    }


    public function searchCategory($search)
    {
        $stmt1 = $this->pdo->prepare("SELECT * FROM {$this->table}
                                    LEFT JOIN tags ON articles.id_tags = tags.id_tags
                                    LEFT JOIN category ON articles.id_category = category.id_category
                                    WHERE articles.id_category = $search");
        $stmt1->execute();

        $autheur = $stmt1->fetchAll();

        return $autheur;
    }



    public function searchTags($search)
    {
        $stmt1 = $this->pdo->prepare("SELECT * FROM {$this->table}
                                    LEFT JOIN tags ON articles.id_tags = tags.id_tags
                                    WHERE articles.id_tags = $search");
        $stmt1->execute();

        $autheur = $stmt1->fetchAll();

        return $autheur;
    }
}
