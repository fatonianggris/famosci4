<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->group("api/client", ['filter' => 'auth'], function ($routes) {
    $routes->get("profile", "UserClient::show");
    $routes->post("login", "UserClient::login");
    $routes->post("register", "UserClient::register");
});
$routes->group("api/talent", ['filter' => 'auth'], function ($routes) {
    $routes->get("profile", "UserTalent::show");
    $routes->post("login", "UserTalent::login");
    $routes->post("register", "UserTalent::register");
});
$routes->group("api/project", ['filter' => 'auth'], function ($routes) {
    $routes->get("all", "UserTalent::index");
    $routes->get("detail/(:any)", "UserTalent::show");
    $routes->post("create", "Project::create");
    $routes->put("update/(:any)", "UserTalent::update");
    $routes->delete("delete/(:any)", "UserTalent::delete");
});
$routes->group("api/contact", ['filter' => 'auth'], function ($routes) {
    $routes->get("all", "Contact::index");
    $routes->get("detail/(:any)", "Contact::show");
    $routes->get("show_client/(:any)", "Contact::show_client");
    $routes->post("create", "Project::Contact");
    $routes->put("update/(:any)", "Contact::update");
    $routes->delete("delete/(:any)", "Contact::delete");
});
$routes->group("api/homepage", ['filter' => 'auth'], function ($routes) {
    $routes->get("detail/(:any)", "Homepage::show");
    $routes->put("update/(:any)", "Homepage::update");
});
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
