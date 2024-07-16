<?php

class RenderView
{

    public function loadView($view, $args)
    {
        extract($args);

        require_once ROOT . "/app/Views/$view.php";
    }
}
