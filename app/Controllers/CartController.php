<?php

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Cart;

class CartController extends Controller
{
    // affiche le panier de l'utilisateur
    public function index()
    {
        $userId = 1; // simule un utilisateur connecté
        $cartItems = Cart::getByUserId($userId);
        $total = Cart::getTotalByUserId($userId);

        $this->render('cart/index', [
            'cartItems' => $cartItems,
            'total' => $total
        ]);
    }

    // ajouter un produit au panier
    public function add($productId, $quantite = 1)
    {
        $userId = 1; // simule un utilisateur connecté
        $cart = new Cart();
        $cart->setUserId($userId);
        $cart->setProductId($productId);
        $cart->setQuantite($quantite);
        $cart->save();

        header('Location: /panier'); 
        exit;
    }

    // supprimer un produit du panier
    public function remove($id) 
    {
        $cart = new Cart();
        $cart->setId($id);
        $cart->delete();

        header('Location: /panier');
        exit;
    }

    // vider le panier
    public function clear()
    {
        $userId = 1; 
        Cart::clearByUserId($userId);

        header('Location: /panier');
        exit;
    }

    // mettre à jour la quantité d’un produit
    public function update($cartId)
    {
        $quantite = $_POST['quantite'] ?? 1; 
        $cart = new Cart();
        $cart->setId($cartId);
        $cart->setQuantite((int)$quantite);
        $cart->updateQuantity(); 

        header('Location: /panier');
        exit;
    }

}
