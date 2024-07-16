<?php

require_once ROOT . "/app/Routes/routes.php";

class Core
{
        // busca pelo controller da pagina pela url
    public function run($routes)
    {
        $url = "/";
        
        isset($_SERVER["REQUEST_URI"]) ? $url = $_SERVER["REQUEST_URI"] : '/';
        
        ($url != "/") ? $url = rtrim($url, '/') : $url ;
        
        $routerFound = false;

        foreach ($routes as $path => $controller) {
            $pattern = '#^' . preg_replace('/{id}/', '([\w-]+|\d+)', $path) . "$#";

            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches);
                $routerFound = true;

                [$currentController, $action] = explode('@', $controller);

                require_once ROOT . "./app/Controllers/$currentController.php";

                $newController = new $currentController();
                $newController->$action($matches);
            }
        }

        if (!$routerFound) {
            echo "
             <style>
                 h1{text-align: center; margin-top: 50vh; font-family: sans-serif; font-weight: 900}
             </style>
             <h1>Page not found!</h1>
             ";
        }
    }
}
