<?php

// Active le mode strict pour la vérification des types
declare(strict_types=1);
// Déclare l'espace de noms pour ce contrôleur
namespace Mini\Controllers;
// Importe la classe de base Controller du noyau
use Mini\Core\Controller;
// Déclare la classe finale HomeController qui hérite de Controller
final class HomeController extends Controller
{
    //declare méthode d'action par défaut pour la page d'accueil
    public function index(): void
    {
        // Appelle le moteur de rendu avec la vue et ses paramètres
        $this->render('home/index', params: [
            // Définit le titre transmis à la vue
            'title' => 'NESZPARFUM', // ton nom de site
        ]);
    }

    // declare la méthode pour afficher les utilisateurs 
    public function users(): void
    {
        // Appelle le moteur de rendu avec la vue et ses paramètres
        $this->render('home/users', params: [
            // Définit le titre transmis à la vue
            'users' => $users = \Mini\Models\User::getAll(),
        ]);
    }
}
