<?php

namespace Models;

abstract class Model
{
    protected $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = \Database::getPdo();
    }


    public function findAll()
    {
        $stmt1 = $this->pdo->query("SELECT * FROM {$this->table} WHERE available = 1");

        $acteurs = $stmt1->fetchAll();
        return $acteurs;
    }
}
