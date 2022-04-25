<?php

namespace Models;

class Article_genre extends Model
{
    protected $table = "article_genre";


    public function insert($genre)
    {

        if (!isset($_SESSION)) {
            session_start();
        }

        $stmt1 = $this->pdo->prepare("INSERT INTO {$this->table} (id_articles, id_tags) VALUES (:last_id, '" . $genre . "')");
        $stmt1->bindParam(':last_id', $_SESSION['last_id']);
        $stmt1->execute();
    }

    // public function selectAll()
    // {

    //     $stmt1 = $this->pdo->prepare("SELECT * FROM {$this->table}
    //                                 RIGHT JOIN articles on article_genre.id_articles = articles.id_article
    //                                 LEFT JOIN tags ON article_genre.id_tags = tags.id_tags");

    //     $stmt1->execute();

    //     $allInfo = $stmt1->fetchAll();

    //     return $allInfo;
    // }
}
