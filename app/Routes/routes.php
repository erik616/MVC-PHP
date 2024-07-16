<?php 

$routes = [
    '/home' => "HomeController@index",
    '/create-bill' => "HomeController@create",
    '/pay-bill/{id}' => "HomeController@pay",
    '/edit-bill/{id}' => "HomeController@edit",
    '/delete/{id}' => "HomeController@delete",
    '/home/filter' => "HomeController@filter",
];