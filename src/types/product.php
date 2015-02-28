<?php

/**
 * @SWG\Resource(
 *     basePath="https://api.gewis.nl/",
 *     resourcePath="product",
 * )
 */
 
/**
 * @SWG\Model(
 *      id="product",
 *      @SWG\Property(
 *             name="id",
 *             type="string",
 *             required=true,
 *             description="The id of the product."
 *         ),
 *      @SWG\Property(
 *             name="name",
 *             type="string",
 *             required=true,
 *             description="The name of the product."
 *         ),
 *      @SWG\Property(
 *             name="price",
 *             type="integer",
 *             required=true,
 *             description="The price in cents."
 *         ),
 *      @SWG\Property(
 *             name="image",
 *             type="string",
 *             required=false,
 *             description="The image displaying the product."
 *         ),
 *      @SWG\Property(
 *             name="almostOut",
 *             type="boolean",
 *             required=false,
 *             description="Whether the product has plenty available, only usefull when requested by a point of sales."
 *         ),
 *      @SWG\Property(
 *             name="sellableFrom",
 *             type="array",
 *             items="$ref:storage",
 *             required=false,
 *             description="Whether the product has plenty available, only usefull when requested by a point of sales."
 *         ),
 *    )
 */
class product {

    /**
     * @SWG\Api(
     *     path="product/{id}",
     *     @SWG\Operation(
     *         summary="Store a product",
     *         method="PUT",
     *         type="product",
     *         nickname="productPUT",
     *         notes="Store a product.",
     *         @SWG\Parameter(
     *             name="id",
     *             type="string",
     *             paramType="path",
     *             required=true,
     *             description="The identifier of the product or 'new' for a new product.",
     *             allowMultiple=false,
     *             defaultValue="new"
     *         ),
     *         @SWG\Parameter(
     *             name="body",
     *             type="string",
     *             paramType="body",
     *             type="product",
     *             required=true,
     *             description="The JSON defining the product",
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
     *     path="product/{id}",
     *     @SWG\Operation(
     *         summary="Get a product",
     *         method="GET",
     *         nickname="productGET",
     *         type="product",
     *         notes="Get a product.",
     *         @SWG\Parameter(
     *             name="id",
     *             type="string",
     *             paramType="path",
     *             required=true,
     *             description="The identifier of the product to query",
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
     *     path="product/{id}/transactions/{type}",
     *     @SWG\Operation(
     *         summary="Get transactions",
     *         method="GET",
     *         nickname="transactionsGET",
     *         type="array",
     *         @SWG\Items("transaction"),
     *         notes="Get all transactions linked to this product.",
     *         @SWG\Parameter(
     *             name="id",
     *             type="string",
     *             paramType="path",
     *             required=true,
     *             description="The identifier of the product to query",
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
     *     path="product/{id}",
     *     @SWG\Operation(
     *         summary="Finalize product",
     *         method="DELETE",
     *         nickname="defaultDELETE",
     *         notes="Delete this product.",
     *         @SWG\Parameter(
     *             name="id",
     *             type="string",
     *             paramType="path",
     *             required=true,
     *             description="The identifier of the product to delete",
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
     *     path="product/{id}/property/{property}",
     *     @SWG\Operation(
     *         summary="Get a property of a product",
     *         method="GET",
     *         nickname="propertyGET",
     *         notes="Get property of this product.",
     *         @SWG\Parameter(
     *             name="id",
     *             type="string",
     *             paramType="path",
     *             required=true,
     *             description="The identifier of the product to query",
     *             allowMultiple=false,
     *             defaultValue=""
     *         ),
     *         @SWG\Parameter(
     *             name="property",
     *             type="string",
     *             paramType="path",
     *             required=true,
     *             description="The property of the product to query",
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
     *     path="product/{id}/property/{property}",
     *     @SWG\Operation(
     *         summary="Set a property of a product",
     *         method="POST",
     *         nickname="propertyPOST",
     *         notes="Set single property.",
     *         @SWG\Parameter(
     *             name="id",
     *             type="string",
     *             paramType="path",
     *             required=true,
     *             description="The identifier of the product to update",
     *             allowMultiple=false,
     *             defaultValue=""
     *         ),
     *         @SWG\Parameter(
     *             name="property",
     *             type="string",
     *             paramType="path",
     *             required=true,
     *             description="The property of the product to update",
     *             allowMultiple=false,
     *             defaultValue=""
     *         ),
     *         @SWG\Parameter(
     *             name="body",
     *             type="string",
     *             paramType="body",
     *             required=true,
     *             description="The value of the property of the product to update",
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
    
    // DO NOT IMPLEMENT
    /**
     * @SWG\Api(
     *     path="product/{id}/pricePolicy",
     *     @SWG\Operation(
     *         summary="Get the price policy of a product",
     *         method="GET",
     *         nickname="pricePolicyGET",
     *         notes="Set a single propery of a product.",
     *         @SWG\Parameter(
     *             name="id",
     *             type="string",
     *             paramType="path",
     *             required=true,
     *             description="The identifier of the product you want the price policy of",
     *             allowMultiple=false,
     *             defaultValue=""
     *         )
     *     )
     * )
     */    
     public static function pricePolicyGET($request){
        return $request;
        // TODO content, return the result
    }
    
    // DO NOT IMPLEMENT
    /**
     * @SWG\Api(
     *     path="product/{id}/pricePolicy",
     *     @SWG\Operation(
     *         summary="Set the price policy of a product",
     *         method="POST",
     *         nickname="pricePolicyPOST",
     *         notes="Set a single propery of a product.",
     *         @SWG\Parameter(
     *             name="id",
     *             type="string",
     *             paramType="path",
     *             required=true,
     *             description="The identifier of the product you want the price policy of",
     *             allowMultiple=false,
     *             defaultValue=""
     *         ),
     *         @SWG\Parameter(
     *             name="body",
     *             type="JSON",
     *             paramType="body",
     *             required=true,
     *             description="The actual price policy to set",
     *             allowMultiple=false,
     *             defaultValue=""
     *         )
     *     )
     * )
     */    
     public static function pricePolicyPOST($request){
        return $request;
        // TODO content, return the result
    }

}

?>
