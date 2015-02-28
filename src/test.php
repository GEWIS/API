<?php

require_once 'database.php';

$db = new Database();

// Checks given GEWIS credentials (email or membership number) and (password or pincode) whether a combination is valid.
function checkGEWISCredentials($username, $pincode){
	global $db;
	return count($db->query("select * from gewis_gewis_lid, websws.users where gewis_gewis_lid.lidnummer=users.login and (pincode=sha1(?) or password=md5(?)) and (users.login=? or gewis_gewis_lid.e_mail=?)", array($pincode, $pincode, $username, $username))) == 1;
}

?>
