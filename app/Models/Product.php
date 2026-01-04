<?php

namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class Product
{
    public static function getAll(): array
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->query("SELECT * FROM products");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById(int $id): array
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getCategories(): array
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->query("SELECT * FROM categories");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getByCategoryId(int $categoryId): array
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM products WHERE category_id = :cat");
        $stmt->execute(['cat' => $categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
