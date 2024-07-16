<?php

// limita o tipo de arquivo que pode ser acessado via url
if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"])) {
    return false;
}

ini_set('display_erros', 1); //exibe os erros
define("ROOT", dirname(__FILE__)); // define a raiz do projeto

require ROOT . "/app/Utils/Functions/Route.php"; // importa a função de validação da rota

spl_autoload_register(function($file){
    if(file_exists(ROOT. "/app/Utils/$file.php")){
        require_once ROOT. "/app/Utils/$file.php";
    }else if(file_exists(ROOT. "/app/Models/$file.php")){
        require_once ROOT. "/app/Models/$file.php";
    }
});
