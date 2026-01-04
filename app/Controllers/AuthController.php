<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\User;

final class AuthController extends Controller
{
    // affiche le formulaire de connexion
    public function login(): void
    {
        $this->render('auth/login', [
            'title' => 'CONNEXION'
        ]);
    }

    //traite le formulaire de connexion 
    
    public function loginPost(): void
    {
        session_start();

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        //on récupère l’utilisateur par email
        $user = User::findByEmail($email);

        // si utilisateur trouvé et mot de passe correct
        if ($user && $user['password'] === $password) {

            // on enregistre l’utilisateur en session
            $_SESSION['user'] = $user;

            //redirection vers l’accueil
            header('Location: /');
            exit;
        }

        //sinon on renvoie avec un message
        $this->render('auth/login', [
            'title' => 'Connexion',
            'error' => 'Email ou mot de passe incorrect'
        ]);
    }

    //affiche le formulaire d'inscription
    public function register(): void
    {
        $this->render('auth/register', [
            'title' => 'INSCRIPTION'
        ]);
    }

    //traite l’inscription
    public function registerPost(): void
    {
        $nom = $_POST['nom'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        //vérifie si l’email existe déjà
        if (User::findByEmail($email)) {
            $this->render('auth/register', [
                'title' => 'Inscription',
                'error' => 'Cet email existe déjà'
            ]);
            return;
        }

        //créer un utilisateur
        $pdo = \Mini\Core\Database::getPDO();
        $stmt = $pdo->prepare("INSERT INTO user (nom, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$nom, $email, $password]);

        //redirection vers connexion
        header('Location: /login');
        exit;
    }
}
