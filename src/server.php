<?php

require_once('oauth/Autoloader.php');
OAuth2\Autoloader::register();

// Fetch the database object.
global $local, $gewis;

// error reporting (this is a demo, after all!)
ini_set('display_errors',1);error_reporting(E_ALL);

// $dsn is the Data Source Name for your database, for exmaple "mysql:dbname=my_oauth2_db;host=localhost"

$storage = new OAuth2\Storage\Pdo($local->getDBN());

// Add the user storage (implemented the interface)
$userStorage = new OAuth2\Storage\UserStorage($gewis);

// Pass a storage object or array of storage objects to the OAuth2 server class
$server = new OAuth2\Server($storage, array('allow_implicit' => true, 'allow_credentials_in_request_body' => true));

// Add the "Client Credentials" grant type
$server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));

// Add the "Authorization Code" grant type
$server->addGrantType(new OAuth2\GrantType\AuthorizationCode($storage));

// Add the "Client Credentials" grant type
$server->addGrantType(new OAuth2\GrantType\UserCredentials($userStorage));

// Add the "Refresh" grant type
$server->addGrantType(new OAuth2\GrantType\RefreshToken($storage));
?>
