<?php

namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class Cart
{
    private $id;
    private $user_id;
    private $product_id;
    private $quantite;
    private $created_at;
    private $updated_at;

    // =====================
    // Getters / Setters
    // =====================

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getUserId() { return $this->user_id; }
    public function setUserId($user_id) { $this->user_id = $user_id; }

    public function getProductId() { return $this->product_id; }
    public function setProductId($product_id) { $this->product_id = $product_id; }

    public function getQuantite() { return $this->quantite; }
    public function setQuantite($quantite) { $this->quantite = $quantite; }

    public function getCreatedAt() { return $this->created_at; }
    public function setCreatedAt($created_at) { $this->created_at = $created_at; }

    public function getUpdatedAt() { return $this->updated_at; }
    public function setUpdatedAt($updated_at) { $this->updated_at = $updated_at; }

    // =====================
    // Méthodes CRUD
    // =====================

    // Récupère tous les articles du panier d’un utilisateur
    public static function getByUserId($user_id)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("
            SELECT p.*, c.quantite, c.id as cart_id, cat.nom AS categorie_nom
            FROM cart c
            INNER JOIN products p ON c.product_id = p.id
            INNER JOIN categories cat ON p.category_id = cat.id
            WHERE c.user_id = ?
            ORDER BY c.created_at DESC
        ");

        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Vérifie si un produit existe déjà pour l’utilisateur
    public static function findByUserAndProduct($user_id, $product_id)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
        $stmt->execute([$user_id, $product_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Ajoute ou met à jour un produit dans le panier
    public function save()
    {
        $pdo = Database::getPDO();
        $existing = self::findByUserAndProduct($this->user_id, $this->product_id);

        if ($existing) {
            $stmt = $pdo->prepare("UPDATE cart SET quantite = ? WHERE user_id = ? AND product_id = ?");
            return $stmt->execute([$this->quantite, $this->user_id, $this->product_id]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO cart (user_id, product_id, quantite) VALUES (?, ?, ?)");
            return $stmt->execute([$this->user_id, $this->product_id, $this->quantite]);
        }
    }

    // Supprime un article du panier
    public function delete()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("DELETE FROM cart WHERE id = ?");
        return $stmt->execute([$this->id]);
    }

    // Vide le panier d’un utilisateur
    public static function clearByUserId($user_id)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = ?");
        return $stmt->execute([$user_id]);
    }

    // Calcule le total du panier
    public static function getTotalByUserId($user_id)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("
            SELECT SUM(p.prix * c.quantite) as total
            FROM cart c
            INNER JOIN products p ON c.product_id = p.id
            WHERE c.user_id = ?
        ");
        $stmt->execute([$user_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0.00;
    }

    // Met à jour uniquement la quantité d’un article
    public function updateQuantity()
    {
            $pdo = Database::getPDO();
        $stmt = $pdo->prepare("UPDATE cart SET quantite = ? WHERE id = ?");
        return $stmt->execute([$this->quantite, $this->id]);
    }

}
