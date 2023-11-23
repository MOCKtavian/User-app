<?php

namespace Framework\Database;

use PDO;

class DatabasePDO implements Database
{
    private string $host = '127.0.0.1';
    private string $db = 'test';
    private string $user = 'root';
    private string $pass = '';
    private string $charset = 'utf8mb4';

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
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id ");
        $stmt->execute($data);
        return $stmt->fetch();
    }

    public function fetchAll(string $table): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function delete(string $table, string $id)
    {
        $data = [
            'id' => $id,
        ];
        $stmt = $this->pdo->prepare('DELETE FROM users WHERE id=:id');
        $stmt->execute($data);
    }

    public function update(string $table)
    {

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
}