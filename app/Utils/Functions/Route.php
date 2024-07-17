<?php

/**
 *  Neste arquivo e feito a importação do Core e das rotas da aplicação,
 *  as rotas são passadas como parametro, 
 *  para que seja feito um mapeamento e tratamento das requisições
 */

require "./app/Core/Core.php";
require "./app/Routes/routes.php";


$core = new Core;
$core->run($routes);