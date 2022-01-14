<?php namespace Config;

/**
 * --------------------------------------------------------------------
 * URI Routing
 * --------------------------------------------------------------------
 * This file lets you re-map URI requests to specific controller functions.
 *
 * Typically there is a one-to-one relationship between a URL string
 * and its corresponding controller class/method. The segments in a
 * URL normally follow this pattern:
 *
 *    example.com/class/method/id
 *
 * In some instances, however, you may want to remap this relationship
 * so that a different class/function is called than the one
 * corresponding to the URL.
 */

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 * The RouteCollection object allows you to modify the way that the
 * Router works, by acting as a holder for it's configuration settings.
 * The following methods can be called on the object to modify
 * the default operations.
 *
 *    $routes->defaultNamespace()
 *
 * Modifies the namespace that is added to a controller if it doesn't
 * already have one. By default this is the global namespace (\).
 *
 *    $routes->defaultController()
 *
 * Changes the name of the class used as a controller when the route
 * points to a folder instead of a class.
 *
 *    $routes->defaultMethod()
 *
 * Assigns the method inside the controller that is ran when the
 * Router is unable to determine the appropriate method to run.
 *
 *    $routes->setAutoRoute()
 *
 * Determines whether the Router will attempt to match URIs to
 * Controllers when no specific route has been defined. If false,
 * only routes that have been defined here will be available.
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('language', 'Home::language', ['as' => 'language']);

$routes->get('login', 'Auth::handle');
$routes->get('login/callback', 'Auth::callback');
$routes->get('logout', 'Auth::logout', ['as' => 'logout']);

$routes->group('dashboard', ['namespace' => 'App\Controllers\Dashboard'], function($routes) {
	$routes->get('/', 'DashboardHome::index', ['as' => 'dashboard']);
	$routes->get('profile', 'DashboardProfile::index', ['as' => 'profile']);
	$routes->post('profile', 'DashboardProfile::updateProfile', ['as' => 'profilePage']);
	$routes->get('notifications', 'DashboardNotification::index', ['as' => 'notification']);
	$routes->get('notifications/delete/(:num)', 'DashboardNotification::notificationDelete/$1', ['as' => 'notificationDelete']);

	$routes->get('search/(:any)', 'DashboardSearch::index/$1', ['as' => 'search']);
	$routes->post('search', 'DashboardSearch::doSearch', ['as' => 'searchPage']);
	$routes->post('search/addlist/(:num)', 'DashboardSearch::inviteToList/$1', ['as' => 'insertToList']);
	
	$routes->post('list', 'DashboardList::createList', ['as' => 'createList']);
	$routes->get('list', 'DashboardList::index', ['as' => 'list']);
	$routes->get('list/view/(:num)', 'DashboardList::read/$1', ['as' => 'viewList']);
	$routes->post('list/view/(:num)', 'DashboardList::createTask/$1', ['as' => 'createTask']);
	$routes->get('list/delete/(:num)', 'DashboardList::deleteList/$1', ['as' => 'deleteList']);
	
	$routes->get('task/delete/(:num)', 'DashboardList::taskDelete/$1', ['as' => 'deleteTask']);
	$routes->get('task/status/(:num)', 'DashboardList::markStatus/$1', ['as' => 'statusTask']);
	$routes->get('task/priority/(:num)', 'DashboardList::changePriority/$1', ['as' => 'priorityTask']);
	$routes->post('task/assignto/(:num)', 'DashboardList::assignTo/$1', ['as' => 'assignTask']);

	//All of GITHUB ROUTES

	$routes->get('github', 'APIRepository::index', ['as' => 'githome']);
	$routes->get('github/view/(:num)', 'APIRepository::read/$1', ['as' => 'githubView']);
	$routes->get('github/cancel/(:num)/(:num)', 'APIRepository::cancel/$1/$2', ['as' => 'issueCancel']);
});
/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
