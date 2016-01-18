<?php

/**
 * @SWG\Swagger(
 *     schemes={"http"},
 *     host="api.gewis.nl",
 *     basePath="/",
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="GEWIS API",
 *         description="",
 *         termsOfService="http://helloreverb.com/terms/",
 *         @SWG\Contact(
 *             email="apiapiapi@gewis.nl"
 *         ),
 *         @SWG\License(
 *             name="Apache 2.0",
 *             url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *         )
 *     ),
 *     @SWG\ExternalDocumentation(
 *         description="Find out more about the GEWIS API",
 *         url="https://api.gewis.nl/docs"
 *     )
 * )
 */


// Parse the call to the API
$call = explode("/",trim($_SERVER['DOCUMENT_URI'],'/'));
$type = strToUpper($_SERVER['REQUEST_METHOD']);

// If no call is specified, redirect to the index page
// This is due to lasinyness by Mart, he does not want to change the NGiNX config anymore
if(empty($call[0])){
	header("location: index.php");
	exit;
}

// Instantiate database objects, note that pgsql cannot work right now due to ip permissions
require_once 'database.php';
$gewis = new Database(); // Standard parameters are set correctely for the mysql db

//$pgsql = new Database('pgsql');
$local = new Database("mysql", "gewisapi", "97f85e750585840024b3a9ab2211b604a0129067", "oauth", "localhost");
$sudosos = new Database("mysql", "gewisapi", "97f85e750585840024b3a9ab2211b604a0129067", "sudosos", "localhost");

$file = array_shift($call);

$secondIsMethod = isset($call[0]) && isMethod($file, $call[0], $type);
$thirdIsMethod = isset($call[1]) && isMethod($file, $call[1], $type);
$defaultIsMethod = isMethod($file, "default", $type);

$method = "default";
if($secondIsMethod){
	$method = array_shift($call);
} else if ($thirdIsMethod){
	$method = $call[1];
	unset($call[1]);
	$call = array_values($call);
} else if (isset($call[0]) && isset($call[1]) && isMethod($file, "property", $type)){
	$method = "property";
} else if (!$defaultIsMethod){
   result(405, "Method not allowed");
}
$method .= $type;

$stdin = file_get_contents("php://input");


$data = new stdClass();
$data->POST = $_POST;
$data->RAWPOST = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : "";
$data->RAWPOSTCONVERT = isset($HTTP_RAW_POST_DATA) ? bestEffortInputConvert($HTTP_RAW_POST_DATA) : "";
$data->GET = $_GET;
$data->STDIN = $stdin; // Used for PUT and DELETE
$data->STDINCONVERT = bestEffortInputConvert($stdin); // Used for PUT and DELETE
$data->CALL = $call;

output($file::$method($data));

/**
 * Do a best effort JSON convert, checking of headers might be added in the future.
 *
 * @param $data String Input string to be converted
 * @return mixed The parse input, JSON on success, String on fail
 */
function bestEffortInputConvert($data){
    $conf = json_decode($data, true);

    if($conf!==false && !empty($conf)){
        return $conf;
    }
    parse_str($data, $conf);
    return $conf!==null?$conf:$data;
}

/**
 * Output the returned data, does a best-effort convert to json and sets the header iff successfull
 *
 * @param $data mixed Data to be returned to the caller
 * @return String The data to be transmitted
 */
function output($data){
    $ret = json_encode($data);
    if($ret!==false){
        header("Content-Type: application/json");
        echo $ret;
    } else {
        echo $data;
    }
}

/**
 * Set the result
 *
 * @param $status integer The statuscode to be set
 * @param $result String The errormessage to display
 * @post Program exits
 */
function result($status, $result){
    http_response_code($status);
    return ($result);
}

/**
 * Check whether the method $name exists in $file for a given $type, also imports the required file
 *
 * @param $file String the filename to check
 * @param $name String the methodname to check
 * @param $type String the type of the request
 * @return boolean True iff the method exists in the file, false otherwise
 * @post The required file is imported
 */
function isMethod($file, $name, $type) {
	if(file_exists("types/$file.php")){
		include_once("types/$file.php");
		if(method_exists($file, $name.$type)){
			return true;
		}
	}
	return false;
}

// DO NOT TOUCH ANYTHING BELOW THIS LINE
/**
 * Check whether the authenticated user has a (set of) scope(s)
 *
 * @param ...$scopes String All scopes that need to be checked
 * @post Error is sent and program is exited on fail
 */
/*
function requireScope(...$scopes){
    global $server;
    if ($server->verifyResourceRequest(OAuth2\Request::createFromGlobals())) {
        $token = $server->getToken();
        $user = $server->getStorage('user_credentials')->getUserDetails($token['user_id']);
	foreach($scopes as $scope){
            if (!$server->getScopeUtil()->checkScope($scope, user['scope'])) {
                error(403,'Unauthorized');
            }
        }
    } else {
        error(403,'Unauthorized');
    }
}
*/

/**
 * Needs to be called when it is required that a user is logged in and has scopes
 * 
 * @post Error is sent and program is exited on fail
 *
function requireAuth(){
    global $server;
    if (!$server->verifyResourceRequest(OAuth2\Request::createFromGlobals())) {
        $server->getResponse()->send();
        error(403, "Unauthorized");
    }
}*/

?>
