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

/**
 * Instantiate a Slim application
 */

$app = new \Slim\Slim();

/**
 * Define the Slim application routes
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */

// GET route
$app->get(
    '/',
    function () {
        $response_body = 'response'; 
        echo $response_body;
    }
);

// POST route
$app->post(
    '/post',
    function () {
        echo 'This is a POST route';
    }
);

// PUT route
$app->put(
    '/put',
    function () {
        echo 'This is a PUT route';
    }
);

// PATCH route
$app->patch('/patch', function () {
    echo 'This is a PATCH route';
});

// DELETE route
$app->delete(
    '/delete',
    function () {
        echo 'This is a DELETE route';
    }
);

/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();
