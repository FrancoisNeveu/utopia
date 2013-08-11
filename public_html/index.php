<?php

/**
 * Check if in development server and server static content as is.
 */
 if (php_sapi_name() == 'cli-server') {
     /* route static assets and return false */
	 if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"])) {
	    return false;    // serve the requested resource as-is.
	 }
 }

/**
 *	Resgister PSR-0 AutoLoader
 */

require '../Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array(
		'mode' => 'development',
		'name' => 'utopia',
	));

$app->contentType('application/json');
$app->expires('-1000000');

/**
 * init Database
 */
try 
{
	$db = new PDO('sqlite:../DB/utopia_db.sqlite3');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
	echo 'Erreur : '.$e->getMessage().'<br />';
	echo 'N° : '.$e->getCode();
}

$app->configureMode('production', function () use ($app) {
	$app->config(array(
		'log.enable' => true,
		'debug' => false
		));
	});

$app->configureMode('development', function () use ($app) {
	$app->config(array(
		'log.enable' => false,
		'debug' => true
		));
	});

/**
 * Then we require all the routes we need in external folder gor better
 * organization.
 */

 require '../api/routes/index.php';

/**
 *  Run the Slim application
 */

$app->run();
