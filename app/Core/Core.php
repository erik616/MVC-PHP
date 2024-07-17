<?php

/**
 * Nesta classe, ocorre a formatação das rotas,
 * logo apos um loop e feito por elas em busca daquela que tem compatibilidade da rota atual,
 * caso haja, é feito um direcionamento para o controlador da rota e seu metodo, 
 * e caso tenha algum parametro ele e passado para o metodo
 */

require_once ROOT . "/app/Routes/routes.php";

class Core
{
    public function run($routes)
    {
        $url = "/";

        isset($_SERVER["REQUEST_URI"]) ? $url = $_SERVER["REQUEST_URI"] : '/';

        ($url != "/") ? $url = rtrim($url, '/') : $url;

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
