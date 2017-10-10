<?php

namespace App;

use Dibi\Connection;

class Repository {
    private $database;

    public function __construct(Connection $database) {
        $this->database = $database;
    }

    public function deleteAll() {
        $this->database->query('DELETE FROM items');
    }

    public function getAll() {
        return $this->database->fetchAll('SELECT * FROM items');
    }

    public function getByDate($date) {
        return $this->database->fetch('SELECT * FROM items WHERE date = ?', $date);
    }

    public function insertItem($date, $min, $max) {
        $this->database->query('INSERT INTO items', [
            'date' => $date,
            'min' => $min,
            'max' => $max
        ]);
    }
}