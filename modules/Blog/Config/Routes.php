<?php

namespace Blog\Config;

// $routes->get('blog', 'BlogController::index', ['namespace' => 'Blog\Controllers']);
// $routes->get('admin/blog', 'AdminController::index', ['namespace' => 'Blog\Controllers', 'filter' => 'session']);

$routes->group('', ['namespace' => 'Blog\Controllers'], static function ($routes) {
    $routes->get('blog', 'BlogController::index');

    $routes->cli('blog/email', 'BlogController::index');

    $routes->add('admin/blog', 'AdminController::index');
    $routes->add('admin/blog/form/(:any)', 'AdminController::form/$1');
    $routes->post('admin/blog/active/(:any)', 'AdminController::active/$1');
    $routes->post('admin/blog/featured/(:any)', 'AdminController::featured/$1');
    $routes->post('admin/blog/private/(:any)', 'AdminController::private/$1');
    $routes->post('admin/blog/delete/(:any)', 'AdminController::delete/$1');
});
