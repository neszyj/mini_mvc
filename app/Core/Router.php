<?php
// Active le mode strict pour les types
declare(strict_types=1);
// Espace de noms du noyau
namespace Mini\Core;
// Déclare le routeur HTTP minimaliste
final class Router
{
    // Tableau contenant toutes les routes 
    private array $routes;

    // Constructeur: reçoit les routes et les stocke
    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

     // Dirige la requête vers le bon contrôleur en fonction méthode/URI
    public function dispatch(string $method, string $uri): void
    {
        // Extrait uniquement le chemin de l'URI
        $path = parse_url($uri, PHP_URL_PATH) ?? '/';

        // Parcourt chaque route enregistrée
        foreach ($this->routes as [$routeMethod, $routePath, $handler]) {

            $pattern = preg_replace('#\{[\w]+\}#', '([\w-]+)', $routePath);
            $pattern = "#^$pattern$#";

            // Vérifie correspondance stricte de méthode et de chemin
            if ($method === $routeMethod && preg_match($pattern, $path, $matches)) {
                array_shift($matches); 

                // Déstructure le gestionnaire en [classe, action]
                [$class, $action] = $handler;
                // Instancie le contrôleur cible
                $controller = new $class();
                // Appelle l'action sur le contrôleur
                $controller->$action(...$matches);
                return;
            }
        }

        // Si aucune route ne correspond, on renvoie un 404 minimaliste
        http_response_code(404);
        echo '404 Not Found';
    }
}
