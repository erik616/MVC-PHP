<?php

require "./app/Core/Core.php";
require "./app/Routes/routes.php";


$core = new Core;
$core->run($routes);