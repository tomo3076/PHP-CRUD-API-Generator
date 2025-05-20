<?php
namespace App;

use PDO;

class ApiGenerator
{
    private PDO $pdo;
    private SchemaInspector $inspector;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->inspector = new SchemaInspector($pdo);
    }

    public function list(string $table): array
    {
        $stmt = $this->pdo->query("SELECT * FROM `$table`");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function read(string $table, $id): ?array
    {
        $pk = $this->inspector->getPrimaryKey($table);
        $stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE `$pk` = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row === false ? null : $row;
    }

    public function create(string $table, array $data): array
    {
        $cols = array_keys($data);
        $placeholders = array_map(fn($col) => ":$col", $cols);
        $sql = sprintf(
            "INSERT INTO `%s` (%s) VALUES (%s)",
            $table,
            implode(',', array_map(fn($c) => "`$c`", $cols)),
            implode(',', $placeholders)
        );
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        $id = $this->pdo->lastInsertId();
        return $this->read($table, $id);
    }

    public function update(string $table, $id, array $data): array
    {
        $pk = $this->inspector->getPrimaryKey($table);
        $sets = [];
        foreach ($data as $col => $val) {
            $sets[] = "`$col` = :$col";
        }
        $sql = sprintf(
            "UPDATE `%s` SET %s WHERE `$pk` = :id",
            $table,
            implode(', ', $sets)
        );
        $stmt = $this->pdo->prepare($sql);
        $data['id'] = $id;
        $stmt->execute($data);
        return $this->read($table, $id);
    }

    public function delete(string $table, $id): bool
    {
        $pk = $this->inspector->getPrimaryKey($table);
        $stmt = $this->pdo->prepare("DELETE FROM `$table` WHERE `$pk` = :id");
        return $stmt->execute(['id' => $id]);
    }
}