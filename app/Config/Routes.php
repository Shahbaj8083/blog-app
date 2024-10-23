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
$routes->delete('/logout', 'UserController::logout');
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
$routes->get('/learning-helper', 'HelperTestController::helperTest');
$routes->delete('user/delete/(:num)', 'DashboardController::delete/$1');
$routes->get('user/edit/(:num)', 'DashboardController::edit/$1');
$routes->post('user/update/(:num)', 'DashboardController::update/$1');