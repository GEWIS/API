<?php

/**
 * @SWG\Resource(
 *     basePath="https://api.gewis.nl/",
 *     resourcePath="activity",
 * )
 */
 
/**
 * @SWG\Model(
 *		id="activity",
 *      @SWG\Property(
 *             name="name",
 *             type="string",
 *             required=true,
 *             description="The name of the activity."
 *         ),
 *      @SWG\Property(
 *             name="startDate",
 *             type="integer",
 *             required=true,
 *             description="The unix timestamp of the start of the activity."
 *         ),
 *      @SWG\Property(
 *             name="endData",
 *             type="integer",
 *             required=true,
 *             description="The unix timestamp of the end of the activity."
 *         ),
 *      @SWG\Property(
 *             name="transactions",
 *             type="array",
 *             items="$ref:transaction",
 *             required=true,
 *             description="The transactions linked to this activity."
 *         ),
 *	)
 */
class activity {

	/**
     * @SWG\Api(
     *     path="activity/{id}",
     *     @SWG\Operation(
     *         summary="Store an activity",
     *         method="PUT",
	 *         type="activity",
     *         nickname="activityPUT",
     *         notes="Store an activity.",
     *         @SWG\Parameter(
     *             name="id",
     *             type="string",
     *             paramType="path",
     *             required=true,
     *             description="The identifier of the activity or 'new' for a new activity.",
     *             allowMultiple=false,
     *             defaultValue="new"
     *         ),
     *         @SWG\Parameter(
     *             name="body",
     *             type="string",
     *             paramType="body",
	 *             type="activity",
     *             required=true,
     *             description="The JSON defining the activity",
     *             allowMultiple=false,
     *             defaultValue=""
     *         )
     *     )
     * )
     */
    public static function defaultPUT($request){
		return $request;
		// TODO content, return the result
	}
	
	/**
     * @SWG\Api(
     *     path="activity/{id}",
     *     @SWG\Operation(
     *         summary="Get an activity",
     *         method="GET",
     *         nickname="activityGET",
	 *         type="activity",
     *         notes="Get an activity.",
     *         @SWG\Parameter(
     *             name="id",
     *             type="string",
     *             paramType="path",
     *             required=true,
     *             description="The identifier of the activity to query",
     *             allowMultiple=false,
     *             defaultValue="new"
     *         )
     *     )
     * )
     */
    public static function defaultGET($request){
		return $request;
		// TODO content, return the result
	}
	
	/**
     * @SWG\Api(
     *     path="activity/{id}/transactions",
     *     @SWG\Operation(
     *         summary="Add transactions to this activity",
     *         method="PUT",
     *         nickname="transactionsPUT",
     *         notes="Add transactions to this activity, note that no transaction can be added to 2 activities.",
     *         @SWG\Parameter(
     *             name="id",
     *             type="string",
     *             paramType="path",
     *             required=true,
     *             description="The identifier of the activity to query",
     *             allowMultiple=false,
     *             defaultValue="new"
     *         ),
     *         @SWG\Parameter(
     *             name="body",
     *             type="JSON",
     *             paramType="body",
     *             required=true,
     *             description="The identifiers of the transactions as JSON array",
     *             allowMultiple=false,
     *             defaultValue=""
     *         )
     *     )
     * )
     */
    public static function transactionsPUT($request){
		return $request;
		// TODO content, return the result
	}
	
	/**
     * @SWG\Api(
     *     path="activity/{id}/transactions",
     *     @SWG\Operation(
     *         summary="Get transactions",
     *         method="GET",
     *         nickname="transactionsGET",
	 *         type="activity",
     *         notes="Get transactions linked to this activity.",
     *         @SWG\Parameter(
     *             name="id",
     *             type="string",
     *             paramType="path",
     *             required=true,
     *             description="The identifier of the activity to query",
     *             allowMultiple=false,
     *             defaultValue=""
     *         )
     *     )
     * )
     */
    public static function transactionsGET($request){
		return $request;
		// TODO content, return the result
	}
	
	/**
     * @SWG\Api(
     *     path="activity/{id}/transactions",
     *     @SWG\Operation(
     *         summary="Remove transactions",
     *         method="DELETE",
     *         nickname="transactionsDELETE",
     *         notes="Removes the specified transactions from this activity.",
     *         @SWG\Parameter(
     *             name="id",
     *             type="string",
     *             paramType="path",
     *             required=true,
     *             description="The identifier of the activity to remove transactions from",
     *             allowMultiple=false,
     *             defaultValue=""
     *         ),
     *         @SWG\Parameter(
     *             name="body",
     *             type="string",
     *             paramType="body",
     *             required=true,
     *             description="The identifiers of the transactions to delete seperated by semicolons (;)",
     *             allowMultiple=false,
     *             defaultValue=""
     *         )
     *     )
     * )
     */
    public static function transactionsDELETE($request){
		return $request;
		// TODO content, return the result
	}
	
	/**
     * @SWG\Api(
     *     path="activity/{id}/close",
     *     @SWG\Operation(
     *         summary="Finalize activity",
     *         method="DELETE",
     *         nickname="closeDELETE",
     *         notes="Close this activity.",
     *         @SWG\Parameter(
     *             name="id",
     *             type="string",
     *             paramType="path",
     *             required=true,
     *             description="The identifier of the activity to close",
     *             allowMultiple=false,
     *             defaultValue=""
     *         )
     *     )
     * )
     */
    public static function closeDELETE($request){
		return $request;
		// TODO content, return the result
	}
	
	/**
     * @SWG\Api(
     *     path="activity/{id}/unclose",
     *     @SWG\Operation(
     *         summary="Unfinalize activity",
     *         method="POST",
     *         nickname="unclosePOST",
     *         notes="Unclose this activity.",
     *         @SWG\Parameter(
     *             name="id",
     *             type="string",
     *             paramType="path",
     *             required=true,
     *             description="The identifier of the activity to unclose",
     *             allowMultiple=false,
     *             defaultValue=""
     *         )
     *     )
     * )
     */
    public static function unclosePOST($request){
		return $request;
		// TODO content, return the result
	}
	
	/**
     * @SWG\Api(
     *     path="activity/{id}/property/{property}",
     *     @SWG\Operation(
     *         summary="Get a property of an activity",
     *         method="GET",
     *         nickname="propertyGET",
     *         notes="Set a single propery of an activity.",
     *         @SWG\Parameter(
     *             name="id",
     *             type="string",
     *             paramType="path",
     *             required=true,
     *             description="The identifier of the activity you want information of",
     *             allowMultiple=false,
     *             defaultValue=""
     *         ),
     *         @SWG\Parameter(
     *             name="property",
     *             type="string",
     *             paramType="path",
     *             required=true,
     *             description="The property of the activity you request",
     *             allowMultiple=false,
     *             defaultValue=""
     *         )
     *     )
     * )
     */    
	 public static function propertyGET($request){
		return $request;
		// TODO content, return the result
	}
	
	/**
     * @SWG\Api(
     *     path="activity/{id}/property/{property}",
     *     @SWG\Operation(
     *         summary="Set a property of an activity",
     *         method="POST",
     *         nickname="propertyPOST",
     *         notes="Unclose this activity.",
     *         @SWG\Parameter(
     *             name="id",
     *             type="string",
     *             paramType="path",
     *             required=true,
     *             description="The identifier of the activity to update",
     *             allowMultiple=false,
     *             defaultValue=""
     *         ),
     *         @SWG\Parameter(
     *             name="property",
     *             type="string",
     *             paramType="path",
     *             required=true,
     *             description="The property of the activity to update",
     *             allowMultiple=false,
     *             defaultValue=""
     *         ),
     *         @SWG\Parameter(
     *             name="body",
     *             type="string",
     *             paramType="body",
     *             required=true,
     *             description="The value of the property of the activity to update",
     *             allowMultiple=false,
     *             defaultValue=""
     *         )
     *     )
     * )
     */    
	 public static function propertyPOST($request){
		return $request;
		// TODO content, return the result
	}

}

?>
