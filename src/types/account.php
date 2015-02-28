<?php

/** TODO
create - Creates, temporary accounts, either guest accounts with a balance, which is not allowed to be negative; other a "factuur" account which does not have a balance, but can be used to send a bill
list - List all account ID's for which the calling entity has permission including closed accounts
get - get information about the requested account
close - close an account has to check that the balance is non-negative
unclose - unclose an account
*/

/** Notes
 - All current GEWIS who agreed to usage of susos, automatically get an account, this is handled in the member database and this can be assumed to be correct
 - Even GEWIS accounts can be closed, to be able to block users from usage
 - No delete will exist, since we do now want to have any possibility for collision with an old account; instead the queries will have to ignore non-existing/closed users when required, maybe add it as an optional parameter
*/

/**
 * @SWG\Resource(
 *     basePath="https://api.gewis.nl/",
 *     resourcePath="account",
 * )
 */

/**
 * @SWG\Model(
 *      id="account",
 *      @SWG\Property(
 *             name="id",
 *             type="string",
 *             required=true,
 *             description="The id of the account."
 *         ),
 *      @SWG\Property(
 *             name="name",
 *             type="string",
 *             required=true,
 *             description="The name of the account."
 *         ),
 *      @SWG\Property(
 *             name="type",
 *             enum="['GEWIS', 'external', 'guest', 'invoice', 'seller']",
 *             required=true,
 *             description="The type of the account (invoice==factuur, seller means a purely selling entity, committee for example)."
 *         ),
 *    )
 */
class account {

	/**
     * @SWG\Api(
     *     path="account/{id}/signature",
     *     @SWG\Operation(
     *         summary="Request a signingnature for a transaction on this account",
     *         method="POST",
     *         nickname="signaturePOST",
     *         notes="Request a signature for a transaction for a given user.",
     *         @SWG\Parameter(
     *             name="id",
     *             type="string",
     *             paramType="path",
     *             required=true,
     *             description="The identifier of the user for the signing request.",
     *             allowMultiple=false,
     *             defaultValue="new"
     *         ),
     *         @SWG\Parameter(
     *             name="body",
     *             type="string",
     *             paramType="body",
     *             required=true,
     *             description="The transaction id returned after creating a new transaction",
     *             allowMultiple=false,
     *             defaultValue=""
     *         )
     *     )
     * )
     */
	public static function signaturePOST($req){
		return "<SOME SIGNATURE>";
	}

}

?>
