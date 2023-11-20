<?php

namespace Framework\Database;

interface Database
{
    public function fetch(string $table, string $id);
    public function fetchAll(string $table);
    public function insert(string $table, ...$params);
    public function update(string $table);
    public function delete(string $table, string $id);
}