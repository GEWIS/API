<?php

/**
 * @SWG\Resource(
 *     basePath="https://api.gewis.nl/"
 * )
 * resourcePath is detected as "/operations" based on the class-name.
 */
class authorization {

    /**
     * @SWG\Api(
     *     path="authorization/",
     *     @SWG\Operation(
     *         summary="Authorize a user using user credentials <b><u><i>IMPLEMENTED</i></u></b>",
     *         method="POST",
     *         nickname="authorize",
     *         notes="Uses GEWIS credentials, being e-mail or membershipnumber and password or pincode.",
     *         @SWG\Parameter(
     *             name="grant_type",
     *             type="string",
     *             paramType="form",
     *             required=true,
     *             description="The grant type requested should <u><b>always</b></u> be set to 'password'.",
     *             allowMultiple=false,
     *             defaultValue="password"
     *         ),
     *         @SWG\Parameter(
     *             name="client_id",
     *             type="string",
     *             paramType="form",
     *             required=true,
     *             description="The client identifier of the calling application",
     *             allowMultiple=false
     *         ),
     *         @SWG\Parameter(
     *             name="client_secret",
     *             type="string",
     *             paramType="form",
     *             required=false,
     *             description="The client secret for the app trying to connect",
     *             allowMultiple=false
     *         ),
     *         @SWG\Parameter(
     *             name="username",
     *             type="string",
     *             paramType="form",
     *             required=true,
     *             description="The users email or GEWIS membership number to use for identification",
     *             allowMultiple=false
     *         ),
     *         @SWG\Parameter(
     *             name="password",
     *             type="string",
     *             paramType="form",
     *             required=true,
     *             description="The users password",
     *             allowMultiple=false
     *         )
     *     )
     * )
     *
     * @SWG\Api(
     *     path="authorization/",
     *     @SWG\Operation(
     *         summary="Authorize a client (app) using client identifier and client secret <b><u><i>IMPLEMENTED</i></u></b>",
     *         method="POST",
     *         nickname="authorize",
     *         notes="Can <u><b>only</b></u> be used for getting or setting information about the app.",
     *         @SWG\Parameter(
     *             name="grant_type",
     *             type="string",
     *             paramType="form",
     *             required=true,
     *             description="Description of the token requested",
     *             allowMultiple=false,
     *             defaultValue="client_credentials"
     *         ),
     *         @SWG\Parameter(
     *             name="client_id",
     *             type="string",
     *             paramType="form",
     *             required=true,
     *             description="The client identifier of the calling application",
     *             allowMultiple=false
     *         ),
     *         @SWG\Parameter(
     *             name="client_secret",
     *             type="string",
     *             paramType="form",
     *             required=true,
     *             description="The client secret for the app trying to connect",
     *             allowMultiple=false
     *         )
     *     )
     * )
     *
     * @SWG\Api(
     *     path="authorization/",
     *     @SWG\Operation(
     *         summary="Authorize a user by having credentials checked by the server <b><u><i>UNIMPLEMENTED</i></u></b>",
     *         method="POST",
     *         nickname="implicit",
     *         notes="Uses the implicit structure to check user credentias, redirects to redirect URI after the user completes the login form successfully.",
     *         @SWG\Parameter(
     *             name="response_type",
     *             type="string",
     *             paramType="form",
     *             required=true,
     *             description="The response type for the authorization request, should <u><b>always</b></u> be set to 'code'",
     *             allowMultiple=false,
     *             defaultValue="code"
     *         ),
     *         @SWG\Parameter(
     *             name="client_id",
     *             type="string",
     *             paramType="form",
     *             required=true,
     *             description="The API key of the calling application.",
     *             allowMultiple=false
     *         ),
     *         @SWG\Parameter(
     *             name="redirect_uri",
     *             type="string",
     *             paramType="form",
     *             required=true,
     *             description="The uri to redirect to after successfull login.",
     *             allowMultiple=false
     *         )
     *     )
     * )
     *
     * @SWG\Api(
     *     path="authorization/",
     *     @SWG\Operation(
     *         summary="Authorize a user by having credentials checked by the server <b><u><i>UNIMPLEMENTED</i></u></b>",
     *         method="POST",
     *         nickname="authorize",
     *         notes="Uses the authorization structure to check user credentials, sends redirect URI as response to a login form so the user can get authenticated.",
     *         @SWG\Parameter(
     *             name="response_type",
     *             type="string",
     *             paramType="form",
     *             required=true,
     *             description="The response type for the authorization request, should <u><b>always</b></u> be set to 'code'",
     *             allowMultiple=false,
     *             defaultValue="code"
     *         ),
     *         @SWG\Parameter(
     *             name="client_secret",
     *             type="string",
     *             paramType="form",
     *             required=true,
     *             description="The client secret for the app trying to connect",
     *             allowMultiple=false
     *         ),
     *         @SWG\Parameter(
     *             name="redirect_uri",
     *             type="string",
     *             paramType="form",
     *             required=true,
     *             description="Where to redirect to when the user finishes the login process.",
     *             allowMultiple=false
     *         ),
     *         @SWG\Parameter(
     *             name="scope",
     *             type="string",
     *             paramType="form",
     *             required=true,
     *             description="The scopes you are trying to request access for.",
     *             allowMultiple=false
     *         )
     *     )
     * )
     *
     * @SWG\Api(
     *     path="authorization/",
     *     @SWG\Operation(
     *         summary="Request access tokens <b><u><i>IMPLEMENTED</i></u></b>",
     *         method="POST",
     *         nickname="authorize",
     *         notes="Request a refresh for a token.",
     *         @SWG\Parameter(
     *             name="response_type",
     *             type="string",
     *             paramType="form",
     *             required=true,
     *             description="The response type for the authorization request, should <u><b>always</b></u> be set to 'refresh_token'",
     *             allowMultiple=false,
     *             defaultValue="refresh_token"
     *         ),
     *         @SWG\Parameter(
     *             name="client_id",
     *             type="string",
     *             paramType="form",
     *             required=true,
     *             description="The client identifier of the calling application",
     *             allowMultiple=false
     *         ),
     *         @SWG\Parameter(
     *             name="client_secret",
     *             type="string",
     *             paramType="form",
     *             required=false,
     *             description="The client secret for the app trying to connect",
     *             allowMultiple=false
     *         ),
     *         @SWG\Parameter(
     *             name="refresh_token",
     *             type="string",
     *             paramType="form",
     *             required=true,
     *             description="The refresh token to retrieve an access token for",
     *             allowMultiple=false
     *         )
     *     )
     * )
     */
    public static function defaultPOST($getParams){
        require_once(__DIR__."/../server.php");
        $resp = ($server->handleTokenRequest(OAuth2\Request::createFromGlobals()));
        http_response_code($resp->getStatusCode());
        return $resp->getParameters();
    }
}

?>
