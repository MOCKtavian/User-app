<?php

namespace Framework\Database;

use PDO;

class DatabasePDO implements Database
{
    private string $host = '127.0.0.1';
    private string $db = 'test';
    private string $user = 'root';
    private string $pass = '';
    private string $charset = 'UTF8';

    private PDO $pdo;
    public function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
    }

    public function getPDO()
    {
        return $this->pdo;
    }

    public function fetch(string $table, string $id)
    {
        $data = [
            'id' => $id,
        ];
        $stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE id = :id ");
        $stmt->execute($data);
        return $stmt->fetch();
    }

    public function fetchAll(string $table): array
    {
        $data = [
            'table' => $table
        ];
        $stmt = $this->pdo->prepare('SELECT * FROM :table');
        $stmt->execute($data);
        return $stmt->fetchAll();
    }

    public function delete(string $table, string $id)
    {
        $data = [
            'table' => $table,
            'id' => $id,
        ];
        $stmt = $this->pdo->prepare('DELETE FROM :table WHERE id=:id');
        $stmt->execute($data);
    }

    public function update(string $table, string $id,  array $values)
    {
        $data = [
            'table' => $table
        ];
        foreach ($values as $key => $value) {
            $data += [$key => $value];
        }

        $stmt = $this->pdo->prepare('UPDATE `:table` SET ');
        $stmt->execute($data);
    }

    public function insert(string $table, ...$params)
    {
        $data = [
            'nume' => $params[0],
            'email' => $params[1],
        ];
        $stmt = $this->pdo->prepare("INSERT INTO users (nume, email) VALUES (:nume, :email);");
        $stmt->execute($data);
    }

    public function lastInsertID(): int
    {
        return $this->pdo->lastInsertId();
    }
}