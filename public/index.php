<?php

use Mini\Core\Router;

// Chargement de l’autoloader Composer
require_once dirname(__DIR__) . '/vendor/autoload.php';

// Définition des routes du site
$routes = [

    // PAGE D’ACCUEIL
    ['GET', '/', [Mini\Controllers\HomeController::class, 'index']],

    // CATÉGORIES
    ['GET', '/categorie', [Mini\Controllers\CategoryController::class, 'index']],
    ['GET', '/categorie/show/{id}', [Mini\Controllers\CategoryController::class, 'show']],

    // PRODUITS
    ['GET', '/products', [Mini\Controllers\ProductController::class, 'index']],            // catalogue complet
    ['GET', '/products/show/{id}', [Mini\Controllers\ProductController::class, 'show']], // détail produit
    ['GET', '/products/category/{id}', [Mini\Controllers\ProductController::class, 'category']], // filtrer par catégorie

    // PANIER
    ['GET', '/panier', [Mini\Controllers\CartController::class, 'index']],
    ['GET', '/cart/add/{id}', [Mini\Controllers\CartController::class, 'add']],
    ['GET', '/cart/remove/{id}', [Mini\Controllers\CartController::class, 'remove']],
    ['GET', '/cart/clear', [Mini\Controllers\CartController::class, 'clear']],
    ['POST', '/cart/update/{id}', [Mini\Controllers\CartController::class, 'update']],


    // AUTHENTIFICATION
    ['GET', '/login', [Mini\Controllers\AuthController::class, 'login']],
    ['POST', '/login', [Mini\Controllers\AuthController::class, 'loginPost']],
    ['GET', '/register', [Mini\Controllers\AuthController::class, 'register']],
    ['POST', '/register', [Mini\Controllers\AuthController::class, 'registerPost']],
];

// Instance du routeur
$router = new Router($routes);

// Dispatch → on envoie méthode + URI
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
