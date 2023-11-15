<?php

namespace Framework\Database;

use PDO;

class Database

{
    private $host = '127.0.0.1';
    private $db = 'test';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8mb4';

    public function getPdo(): PDO
    {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        return new PDO($dsn, $this->user, $this->pass, $options);
    }

    public function fetch()
    {
    }

    public function fetchAll()
    {
    }

    public function delete()
    {
    }

    public function update()
    {
    }

    public function create()
    {
        $sql = '';
        $this->getPdo()->prepare($sql)->execute([$this->name, $this->id]);
    }
}