<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'UserController::login');
$routes->post('/login', 'UserController::login');
$routes->post('/register', 'UserController::register');
$routes->get('/register', 'UserController::register');
// $routes->post('/register', function () {
//     $request = \Config\Services::request(); // Get the request service
    
//     // Get the request data
//     $data = $request->getPost();

//     // Print the request data
//     echo '<pre>';
//     print_r($data);
//     echo '</pre>';
// });

$routes->get('/dashboard', 'UserController::dashboard');
