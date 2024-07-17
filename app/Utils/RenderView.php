<?php
/**
 *  Classe responsavel por redenrizar as views e passar para elas os argumentos e dados a serem exibidos
 */

class RenderView
{

    public function loadView($view, $args)
    {
        extract($args);

        require_once ROOT . "/app/Views/$view.php";
    }
}
