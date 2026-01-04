<?php

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Product;

class ProductController extends Controller
{
    // affiche tous les produits 
    public function index()
    {
        $products = Product::getAll();
        $categories = Product::getCategories();

        $this->render('products/index', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    // affiche un produit
    public function show($id)
    {
        $product = Product::getById($id);

        $this->render('products/show', [
            'product' => $product
        ]);
    }

    // affiche les produits d'une catégorie
    public function category($categoryId)
    {
        $products = Product::getByCategoryId($categoryId);
        $categories = Product::getCategories();

        $this->render('products/index', [
            'products' => $products,
            'categories' => $categories,
            'selectedCategory' => $categoryId
        ]);
    }
}
