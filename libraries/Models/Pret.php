<?php

namespace Models;

class Pret extends Model
{
    protected $table = "pret";

    public function getHistorique()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        $stmt1 = $this->pdo->prepare("SELECT * from {$this->table}
                                    LEFT JOIN articles ON pret.id_article = articles.id_article
                                    WHERE id_user = :id_user");

        $stmt1->bindParam(':id_user', $_SESSION['is_logged']);
        $stmt1->execute();
        $pret = $stmt1->fetchAll();


        return $pret;
    }
    public function getAvailable()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        $stmt1 = $this->pdo->prepare("SELECT pret.id_user, pret.available, pret.id_article,pret.date_release, DATEDIFF(CURRENT_DATE(),                           date_release) AS date,
                                    articles.fname, articles.lname, articles.title, articles.img, articles.content, articles.date_put, articles.date_update, articles.id_category, articles.available, articles.collection, articles.edition,
                                    CASE
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -1 AND 0 THEN 'C\'est votre dernier jour avant de devoir rendre cet article...'
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -2 AND -1 THEN 'Il vous reste 2 jours avant de devoir rendre cet article...'
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -3 AND -1 THEN 'Il vous reste 3 jours avant de devoir rendre cet article...'
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -4 AND -1 THEN 'Il vous reste 4 jours avant de devoir rendre cet article...'
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -5 AND -1 THEN 'Il vous reste 5 jours avant de devoir rendre cet article...'
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -6 AND -1 THEN 'Il vous reste 6 jours avant de devoir rendre cet article...'
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -7 AND -1 THEN 'Il vous reste 7 jours avant de devoir rendre cet article...'
                                    ELSE 'Vous avez dépassé le temps imparti...'
                                    END AS 'status'
                                    FROM {$this->table}
                                    LEFT JOIN articles ON pret.id_article = articles.id_article
                                    WHERE pret.id_user = :id_user AND pret.available = 1");
        $stmt1->bindParam(':id_user', $_SESSION['is_logged']);
        $stmt1->execute();
        $pret = $stmt1->fetchAll();

        return $pret;
    }

    public function returnBook($id)
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        $stmt1 = $this->pdo->prepare("UPDATE {$this->table} SET available = 0
                                    WHERE id_article = :id_article");
        $stmt1->bindParam(':id_article', $id);
        $stmt1->execute();

        $stmt2 = $this->pdo->prepare("UPDATE articles SET available = 1 WHERE id_article = :id_article");
        $stmt2->bindParam(':id_article', $id);
        $stmt2->execute();
    }

    public function occupedBooks()
    {
        $stmt1 = $this->pdo->prepare("SELECT pret.id_user, pret.available, pret.id_article,pret.date_release, DATEDIFF(CURRENT_DATE(),                           date_release) AS date,
                                    articles.fname, articles.lname, articles.title, articles.img, articles.content, articles.date_put, articles.date_update, articles.id_category, articles.available, articles.collection, articles.edition,
                                    users.fname, users.lname, users.email, users.adress, users.city, users.zip_code, users.id_role,
                                    CASE
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -1 AND 0 THEN 'Il vous reste 1 jour'
                                    WHEN DATEDIFF(CURRENT_DATE(), date_release) BETWEEN -7 AND -1 THEN 'Il y a encore du temps'
                                    ELSE 'Trop tard'
                                    END AS 'status'
                                    FROM {$this->table}
                                    LEFT JOIN articles ON pret.id_article = articles.id_article
                                    LEFT JOIN users on pret.id_user = users.id_user
                                    WHERE pret.available = 1");

        $stmt1->execute();
        $pret = $stmt1->fetchAll();

        return $pret;
    }
}
