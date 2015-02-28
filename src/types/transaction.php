<?php

/**
 * @SWG\Resource(
 *     basePath="https://api.gewis.nl/",
 *     resourcePath="transaction",
 * )
 */

/**
 * @SWG\Model(
 *		id="transaction",
 *      @SWG\Property(
 *             name="id",
 *             type="string",
 *             required=true,
 *             description="The id of the transaction."
 *         ),
 *      @SWG\Property(
 *             name="price",
 *             type="integer",
 *             required=true,
 *             description="The price in cents handled in the transaction."
 *         ),
 *      @SWG\Property(
 *             name="from",
 *             type="string",
 *             required=true,
 *             description="The identifier of the entity who makes the transaction."
 *         ),
 *      @SWG\Property(
 *             name="to",
 *             type="string",
 *             required=true,
 *             description="The identifier of the entity which receives the transaction."
 *         ),
 *      @SWG\Property(
 *             name="who",
 *             type="string",
 *             required=true,
 *             description="The identifier of the entity making the transaction."
 *         ),
 *      @SWG\Property(
 *             name="what",
 *             type="string",
 *             required=true,
 *             description="The product identification of the purchase. (combination of product and storage)"
 *         ),
 *      @SWG\Property(
 *             name="type",
 *             enum="['purchase', 'payment', 'revert']",
 *             required=true,
 *             description="The type of transaction."
 *         ),
 *      @SWG\Property(
 *             name="date",
 *             type="integer",
 *             required=true,
 *             description="The timestamp of transaction."
 *         ),
 *      @SWG\Property(
 *             name="description",
 *             type="string", 
 *             required=true,
 *             description="Description of the transaction, should be filled with a human readable description of the transaction (A purchases B / Transaction '' reverted because of {comment}."
 *         ),
 *      @SWG\Property(
 *             name="comment",
 *             type="string", 
 *             required=true,
 *             description="Comment to the transaction."
 *         ),
 *	)
 */

class transaction {

    /**
     * @SWG\Api(
     *     path="transaction/",
     *     @SWG\Operation(
     *         summary="Create a new transaction",
     *         method="PUT",
     *         nickname="transactionPUT",
     *         notes="Create a new transaction. Transactions are immutable and cannot be changed after creation. Returns an transactionId, which has to be used for signing.",
     *         @SWG\Parameter(
     *             name="id",
     *             type="string",
     *             paramType="path",
     *             required=true,
     *             description="The identifier of the transaction or 'new' for a new transaction.",
     *             allowMultiple=false,
     *             defaultValue="new"
     *         ),
     *         @SWG\Parameter(
     *             name="body",
     *             type="string",
     *             paramType="body",
     *             type="transaction",
     *             required=true,
     *             description="The JSON defining the transaction",
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
     *     path="transaction/{id}",
     *     @SWG\Operation(
     *         summary="Get a transaction",
     *         method="GET",
     *         nickname="transactionGET",
     *         type="transaction",
     *         notes="Get a transaction.",
     *         @SWG\Parameter(
     *             name="id",
     *             type="string",
     *             paramType="path",
     *             required=true,
     *             description="The identifier of the transaction to query",
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
     *     path="transaction/{id}/transactions/{type}",
     *     @SWG\Operation(
     *         summary="Get transactions",
     *         method="GET",
     *         nickname="transactionsGET",
     *         type="array",
     *         @SWG\Items("transaction"),
     *         notes="Get all transactions linked to this transaction.",
     *         @SWG\Parameter(
     *             name="id",
     *             type="string",
     *             paramType="path",
     *             required=true,
     *             description="The identifier of the transaction to query",
     *             allowMultiple=false,
     *             defaultValue=""
     *         ),
     *         @SWG\Parameter(
     *             name="type",
     *             type="string",
     *             enum="['all', 'mine']",
     *             paramType="path",
     *             required=true,
     *             description="The type of transactions to retrieve, empty = 'mine'",
     *             allowMultiple=false,
     *             defaultValue="mine"
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
     *     path="transaction/{id}",
     *     @SWG\Operation(
     *         summary="Finalize transaction",
     *         method="DELETE",
     *         nickname="defaultDELETE",
     *         notes="Undo this transaction by inserting a new transaction negating this one. This should be done usign a special type of transaction which as product has {id}",
     *         @SWG\Parameter(
     *             name="id",
     *             type="string",
     *             paramType="path",
     *             required=true,
     *             description="The identifier of the transaction to undo",
     *             allowMultiple=false,
     *             defaultValue=""
     *         )
     *     )
     * )
     */
    public static function defaultDELETE($request){
        return $request;
        // TODO content, return the result
    }
    
    /**
     * @SWG\Api(
     *     path="transaction/{id}/property/{property}",
     *     @SWG\Operation(
     *         summary="Get a property of a transaction",
     *         method="GET",
     *         nickname="propertyGET",
     *         notes="Get property of this transaction.",
     *         @SWG\Parameter(
     *             name="id",
     *             type="string",
     *             paramType="path",
     *             required=true,
     *             description="The identifier of the transaction to query",
     *             allowMultiple=false,
     *             defaultValue=""
     *         ),
     *         @SWG\Parameter(
     *             name="property",
     *             type="string",
     *             paramType="path",
     *             required=true,
     *             description="The property of the transaction to query",
     *             allowMultiple=false,
     *             defaultValue=""
     *         ),
     *     )
     * )
     */
     public static function propertyGET($request){
        return $request;
        // TODO content, return the result
    }

    /**
     * @SWG\Api(
     *     path="transaction/commit",
     *     @SWG\Operation(
     *         summary="Create a new transaction",
     *         method="POST",
     *         nickname="commitPUT",
     *         notes="Create a new transaction. Transactions are immutable and cannot be changed after creation",
     *         @SWG\Parameter(
     *             name="body",
     *             type="string",
     *             paramType="body",
     *             required=true,
     *             description="The signature of the request, given by /account/{id}/signature and the id of a request",
     *             allowMultiple=false,
     *             defaultValue=""
     *         )
     *     )
     * )
     */
    public static function commitPOST($request){
        return $request;
        return array("success" => "true");
    }

    /* NOTE: THIS DOES NOT HAVE DOUBLE * SINCE WE DO NOT WANT IT TO PARSE INTO THE DOCS
     * @SWG\Api(
     *     path="transaction/list/{id}/{type}",
     *     @SWG\Operation(
     *         summary="List transactions for a given entity",
     *         method="POST",
     *         nickname="listGET",
     *         notes="List all transactions for a given entity.",
     *         @SWG\Parameter(
     *             name="id",
     *             type="string",
     *             paramType="path",
     *             required=true,
     *             description="The identifier of the transaction or 'new' for a new transaction.",
     *             allowMultiple=false,
     *             defaultValue="new"
     *         ),
     *         @SWG\Parameter(
     *             name="body",
     *             type="string",
     *             paramType="body",
     *             required=true,
     *             description="The signature of the request, given by /account/{id}/signature",
     *             allowMultiple=false,
     *             defaultValue=""
     *         )
     *     )
     * )
     */
    public static function listGET($request){
        return array("success" => "true");
    }
    
}

?>