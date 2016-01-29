<?php

namespace OAuth2\Storage;

class UserStorage implements UserCredentialsInterface {

    private $db;

    function __construct($connection){
        $this->db = $connection;
    }

    /**
     * Grant access tokens for basic user credentials.
     *
     * Check the supplied username and password for validity.
     *
     * You can also use the $client_id param to do any checks required based
     * on a client, if you need that.
     *
     * Required for OAuth2::GRANT_TYPE_USER_CREDENTIALS.
     *
     * @param $username
     * Username to be check with.
     * @param $password
     * Password to be check with.
     *
     * @return
     * TRUE if the username and password are valid, and FALSE if it isn't.
     * Moreover, if the username and password are valid, and you want to
     *
     * @see http://tools.ietf.org/html/rfc6749#section-4.3
     *
     * @ingroup oauth2_section_4
     */
    public function checkUserCredentials($username, $password) {
        return count($this->db->query("select * from gewis_gewis_lid, websws.users where gewis_gewis_lid.lidnummer=users.login and (pincode=sha1(?) or password=md5(?)) and (users.login=? or gewis_gewis_lid.e_mail=?)", array($password, $password, $username, $username))) == 1;        
    }

    /**
     * @return
     * ARRAY the associated "user_id" and optional "scope" values
     * This function MUST return FALSE if the requested user does not exist or is
     * invalid. "scope" is a space-separated list of restricted scopes.
     * @code
     * return array(
     *     "user_id"  => USER_ID,    // REQUIRED user_id to be stored with the authorization code or access token
     *     "scope"    => SCOPE       // OPTIONAL space-separated list of restricted scopes
     * );
     * @endcode
     */
    public function getUserDetails($username) {
        return array(
            "user_id" => 1, //TODO: This needs to be something wrt to the database 
            "scope" => "ALL" // TODO: Also something from the database
        );
    }
}
