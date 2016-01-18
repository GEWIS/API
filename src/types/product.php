<?php
/*
/*
 * @SWG\Resource(
 *     basePath="https://api.gewis.nl/",
 *     resourcePath="product",
 * )
 */

/**
 * @SWG\Definition(
 *      definition="product",
 *      required={"ID","name","price","ownerID"},
 *      @SWG\Property(
 *             property="ID",
 *             type="integer",
 *             description="The ID of the product"
 *         ),
 *      @SWG\Property(
 *             property="name",
 *             type="string",
 *             description="The name of the product"
 *         ),
 *      @SWG\Property(
 *             property="price",
 *             type="integer",
 *             description="The price in cents"
 *         ),
 *      @SWG\Property(
 *             property="image",
 *             type="string",
 *             description="The image displaying the product"
 *         ),
 *      @SWG\Property(
 *             property="traySize",
 *             type="integer",
 *             description="Number of products in a tray of the product"
 *         ),
 *		 @SWG\Property(
 *             property="category",
 *             type="enum",
 *			   enum="['Drink', 'Food', 'Ticket', 'Other']",
 *             description="Category the product belongs to"
 *         ),
 *      @SWG\Property(
 *             property="ownerID",
 *             type="integer",
 *             description="ID of the owner from this product"
 *         ),
 *		 @SWG\Property(
 *             property="created_at",
 *             type="dateTime",
 *             description="Time of creation"
 *         ),
 *		 @SWG\Property(
 *             property="updated_at",
 *             type="dateTime",
 *             description="Time of last update"
 *         ),
 *		 @SWG\Property(
 *             property="deleted_at",
 *             type="dateTime",
 *             description="Time of deletion (inactive)"
 *         ),
 *    )
 */
 
 /**
 * @SWG\Definition(
 * definition="inputProduct",
 *      required={"name","price","ownerID"},
 *      @SWG\Property(
 *             property="name",
 *             type="string",
 *             description="The name of the product"
 *         ),
 *      @SWG\Property(
 *             property="price",
 *             type="integer",
 *             description="The price in cents"
 *         ),
 *      @SWG\Property(
 *             property="image",
 *             type="string",
 *             description="The image displaying the product"
 *         ),
 *      @SWG\Property(
 *             property="traySize",
 *             type="integer",
 *             description="Number of products in a tray of the product"
 *         ),
 *      @SWG\Property(
 *             property="ownerID",
 *             type="integer",
 *             description="ID of the owner from this product"
 *         ),
 *		 @SWG\Property(
 *             property="category",
 *             type="enum",
 *			   default="Other",
 *			   enum={"Drink", "Food", "Ticket", "Other"},
 *             description="Category the product belongs to"
 *         ),
 *    )
 */
 
 /**
 * @SWG\Definition(
 * definition="putProduct",
 *      required={"ID","name","price","ownerID"},
 *		@SWG\Property(
 *             property="ID",
 *             type="integer",
 *             description="The ID of the product"
 *         ),
 *      @SWG\Property(
 *             property="name",
 *             type="string",
 *             description="The name of the product"
 *         ),
 *      @SWG\Property(
 *             property="price",
 *             type="integer",
 *             description="The price in cents"
 *         ),
 *      @SWG\Property(
 *             property="image",
 *             type="string",
 *             description="The image displaying the product"
 *         ),
 *      @SWG\Property(
 *             property="traySize",
 *             type="integer",
 *             description="Number of products in a tray of the product"
 *         ),
 *      @SWG\Property(
 *             property="ownerID",
 *             type="integer",
 *             description="ID of the owner from this product"
 *         ),
 *		 @SWG\Property(
 *             property="category",
 *             type="enum",
 *			   enum="['Drink', 'Food', 'Ticket', 'Other']",
 *             description="Category the product belongs to",
 *         ), 
 *		 @SWG\Property(
 *             property="active",
 *             type="boolean",
 *			   default = true,
 *             description="Whether the product is active",
 *         ),
 *    )
 */
 
class product {

	 /**
     * @SWG\Get(
	 *	   tags={"product"},
     *     path="product/",
	 *	   summary="Gets all products",
	 *	   description= "Returns all active products.",  
	 *	 @SWG\Response(
     *       response = 500,
     *       description = "Something went wrong",
     *        ),
     *   @SWG\Response(
     *      response = 200,
     *      description = "Success",
     *   	@SWG\Schema(type="array", @SWG\Items(ref="#/definitions/product")),
     *      ),
     *    )
     */
	 
    /**
     * @SWG\Get(
     *     path="product/{id}",
	 *	   summary="Get a product",
	 *	   tags={"product"},
	 *	   description= "Returns the product for given ID.",
     *    @SWG\Parameter(
	 *		   name="ID", 	
     *         type="integer",     
     *         in="path",
     *         required=false,
     *         description="The identifier of the product",
     *         ),
	 *		  @SWG\Response(
     *        response = 406,
     *        description = "Invalid parameter",
     *      ),
	 *	      @SWG\Response(
     *        response = 404,
     *        description = "Product not found",
     *      ),
	 *		 @SWG\Response(
     *        response = 500,
     *        description = "Something went wrong",
     *      ),
	 * 		@SWG\Response(
     *      response = 200,
     *      description = "Success",
     *   @SWG\Schema(ref="#/definitions/product"),
     *      ),
     *    ),
     */
    public static function defaultGET($request) {
        global $sudosos;
        if(!isset($request->CALL[0])){
			// Return all.
            $result = $sudosos->query("SELECT * FROM product",array(null), PDO::FETCH_ASSOC);
            if($result->ERROR){
                return result(500, "Something went wrong");
            }
            return $result->RESULT;
            
        } else {		
			if(!is_numeric($request->CALL[0]) || is_null($request->CALL[0])){
			return result(406, "Invalid parameter"); 
			}
			
            $result = $sudosos->query("SELECT * FROM product WHERE id=?", array($request->CALL[0]), PDO::FETCH_ASSOC);

			if($result->ERROR){
                return result(500, "Something went wrong");
            }
			
            if(count($result->RESULT) !== 1){
                return result(404, "Product not found");
            }

            return $result->RESULT[0];
        }
    }
	
	/**
     * @SWG\Post(
     *     tags={"product"},
     *     path="product/",
     *     summary="Store a product",
     *     @SWG\Parameter(
	 *		   name="Product", 
     *         in="body",
     *         type="inputProduct",
     *         parameter="body",
     *         required=true,
     *         description="Model of the product to store",
	 *		@SWG\Schema(ref="#/definitions/inputProduct"),
     *         ),
	 *		@SWG\Response(
     *          response = 200,
     *          description = "Success",
     *      ),@SWG\Response(
     *          response = 406,
     *          description = "Missing parameter(s) / Invalid parameter(s)",
     *      ),@SWG\Response(
     *          response = 404,
     *          description = "Owner not found",
     *          ),
	 *		),@SWG\Response(
	 *			response=500,
	 *			description = "Something went wrong")
     *     )
     */
    public static function defaultPOST($request) {
        global $sudosos;
        $json = $request->STDINCONVERT;
        $name = $json['name'];
        $price = $json['price'];
        $image = $json['image'];
        $traySize = $json['traySize'];
        $ownerID = $json['ownerID'];
		$category = $json['category'];	

		
        if(!isset($name) ||!isset($price) || !isset($ownerID)){
            return result(406, "Missing parameter(s)");
        }
		if(!is_numeric($price) || !is_numeric($traySize) || !is_numeric($ownerID)){
			return result(406, "Invalid parameter(s)");
		}
		
        $result = $sudosos->query("INSERT INTO product (name,price,image,traySize,ownerID,category)
            VALUES (?, ?, ?, ?, ?, ?)", array($name,$price,$image,$traySize,$ownerID,$category));		
        		
		if(($result->ERRORINFO[0][2]) == "Cannot add or update a child row: a foreign key constraint fails (`sudosos`.`product`, CONSTRAINT `product_ibfk_1` FOREIGN KEY (`ownerID`) REFERENCES `users` (`ID`))"){
			return result(404, "Owner not found");
		}
        if($result->ERROR){
            return result(500, "Something went wrong");
        }
        return result(200, "Success");
    }

	/**
     * @SWG\Put(
	 *	   tags={"product"},
     *     path="product/{id}",
	 *	   summary="Update the whole product",
     *     description="Update product using the product model definition.",
     *         @SWG\Parameter(
     *            name="product",
     *            in="body",
     *            parameter="body",
     *            type="product",
     *            required=true,
     *            description="The model of the product to update.",
     *            @SWG\Schema(ref="#/definitions/putProduct"),
     *         ),
	 *       @SWG\Response(
     *        response = 406,
     *        description = "Invalid parameters",
     *       ),@SWG\Response(
     *        response = 404,
     *        description = "Owner not found / Product not found",
	 *		 ),@SWG\Response(
     *        response = 200,
     *        description = "Success",
	 *		), @SWG\Response(
	 *			response = 500,
	 *			description = "Something went wrong",
     * 			)
	 *    )
     */
	 public static function defaultPUT($request){

		global $sudosos;
        $json = $request->STDINCONVERT;
		$id = $json['ID'];
        $name = $json['name'];
        $price = $json['price'];
        $image = $json['image'];
        $traySize = $json['traySize'];
        $ownerID = $json['ownerID'];
		$category = $json['category'];
		$active = $json['active'];
        if(!isset($name) ||!isset($price) || !isset($ownerID) || !isset($id) || !is_bool($active)){
            return result(406, "Missing parameter(s)");
        }
		if(!is_numeric($id) || !is_numeric($price) || !is_numeric($traySize) || !is_numeric($ownerID) || 
				!($category == "Other" || $category == "Drink" || $category == "Food" || $category == "Ticket")){
			return result(406, "Invalid parameter(s)");
		}
		
		if($active){
			$active = null;
		} else {
			$timestamp = date('Y-m-d G:i:s');
			$active = $timestamp;
		}
		$res = $sudosos->query("SELECT * FROM users where ID=?", array($ownerID));
			
		if($res->COUNT !== 1){
			return result(404, "Owner not found");
		}
        if($res->ERROR){
            return result(500, "Something went wrong");
        }
		
		$res2 = $sudosos->query("SELECT ID FROM product where ID=?", array($id));
			
		if($res2->COUNT !== 1){
			return result(404, "Product not found");
		}
        if($res2->ERROR){
            return result(500, "Something went wrong");
        }
	
        $result = $sudosos->query("UPDATE product SET name = ?, price=?, image=?, traySize=?, ownerID=?, category=?, deleted_at=? WHERE ID=?", array($name,$price,$image,$traySize,$ownerID,$category,$active,$id));
			
	
        if($result->ERROR){
			return $result->ERRORINFO[0][2];
            return result(500, "Something went wrong");
        }
        
        return result(200, "Success");
    }
	
    /**
     * @SWG\Post(
	 *	   tags={"product"},
     *     path="product/{id}/reinstate/",
     *     summary="Reinstate product",
     *     description="Reinstates this product.",    
     *         @SWG\Parameter(
     *             name="id",
     *             type="integer",
     *             in="path",
     *             required=true,
     *             description="The identifier of the product to reinstate",
     *         ),
	 *		 @SWG\Response(
     *        response = 406,
     *        description = "Invalid parameter",
     *       ),@SWG\Response(
     *        response = 404,
     *        description = "Product not found",
	 *		 ),@SWG\Response(
     *        response = 200,
     *        description = "Success",
	 *		),@SWG\Response(
     *        response = 500,
     *        description = "Something went wrong",
     *      ), @SWG\Response(
     *        response = 409,
     *        description = "Product already active",
	 *		 ),
     *     )
     */
    public static function reinstatePOST($request) {
        global $sudosos;
        			
		if(!is_numeric($request->CALL[0])){
            return result(406 ,"Invalid parameter");
        } 
		  
        $id = $request->CALL[0];
      	$result = $sudosos->query("SELECT deleted_at FROM product WHERE id=?", array($id));
		
		if(($result->COUNT) !== 1){
			return result(404,"Product not found");
		}
		
		if(is_null($result->RESULT[0][0])){
			return result(409, "Product already active");
		}
		
        $result = $sudosos->query("UPDATE product SET deleted_at=?  WHERE id=? AND deleted_at is not null", array(null,$id));
     
		if($result->ERROR){
			return result(500, "Something went wrong");
		}	
		return result(200, "Success");
    }

    /**
     * @SWG\Delete(
	 *	   tags={"product"},
     *     path="product/{id}/",
	 *	   summary="Disable a product",
	 *	   description="Disables the product",
     *     @SWG\Parameter( 
     *             name="ID",
     *             type="integer",
     *             in="path",
     *             required=true,
     *             description="The ID of the product to disable",
	 *		),
	 *		@SWG\Response(
     *        response = 200,
	 *        description = "Success",
     *     ),
	 *		@SWG\Response(
     *        response = 404,
     *        description = "Product not found",
	 *		 ),
	 *		 @SWG\Response(
     *        response = 406,
     *        description = "Invalid parameter",
	 *		 ),
	 *		 @SWG\Response(
     *        response = 409,
     *        description = "Product already disabled",
	 *		 ),
	 *		 @SWG\Response(
     *        response = 500,
     *        description = "Something went wrong",
     *      ),
     * )
     */
    public static function defaultDELETE($request) {
        global $sudosos;
	     
		if(!is_numeric($request->CALL[0])){
			return result(406, "Invalid parameter");
		}
            
        $id = $request->CALL[0];
		
		$result = $sudosos->query("SELECT deleted_at FROM product WHERE id=?", array($id));
		
		if(($result->COUNT) !== 1){
			return result(404,"Product not found");
		}
		
		if(!is_null($result->RESULT[0][0])){
			return result(409, "Product already disabled");
		}
		
		$timestamp = date('Y-m-d G:i:s');
        $result = $sudosos->query("UPDATE product SET deleted_at=?  WHERE ID=? AND deleted_at is null", array($timestamp,$id));
     
		if($result->ERROR){
			return result(500, "Something went wrong");
		}	
		return result(200, "Success");
    }

	 /**
     * @SWG\Get(
	 *	   tags={"product"},
     *     path="product/{id}/{property}",
	 *	   summary="Get a property of a product",
     *     description="Get property of this product.",
     *         @SWG\Parameter(
     *             name="ID",
     *             type="integer",
     *             in="path",
     *             required=true,
     *             description="The identifier of the product to query",
	 *			),
     *         @SWG\Parameter(
     *             name="property",
     *             type="string",
     *             in="path",
     *             required=true,
     *             description="The property of the product to query",
     *         ),
	 * 		@SWG\Response(
     *        response = 200,
	 *        description = "Success",
     *     ),
	 *		@SWG\Response(
     *        response = 400,
	 *        description = "Missing parameter(s)",
     *     ),
	 *		@SWG\Response(
     *        response = 406,
	 *        description = "Invalid parameter",
     *     ), 
     *  	@SWG\Response(
     *        response = 404,
	 *        description = "Product not found",
     *     ),
	 *	@SWG\Response(
     *        response = 405,
	 *        description = "Method not allowed",
     *     ),
     *  )
     */
    public static function propertyGET($request) {
        global $sudosos;
  
		if (count($request->CALL) < 1) {
            return result(400, "Missing parameter(s)");
        }
		
		if(!is_numeric($request->CALL[0])){
		return result(406, "Invalid parameter");
			}
		
        $id = $request->CALL[0];
        $property = $request->CALL[1];
        
        $result = $sudosos->query("SELECT * FROM product WHERE id=?", array($id));
        
        if ($result->ERROR){
            return result(500, "Something went wrong");
		}
        if (count($result->RESULT) !== 1){
            return result(404, "Product not found");
		}	
        $pos = $result->RESULT[0];

        if (!array_key_exists($property, $pos)){
            return result(405, "Method not allowed");
		}
        return $pos[$property];
    }

    /**
     * @SWG\Post(
	 *	   tags={"product"},
     *     path="product/{id}/{property}",
	 *	   summary="Set a property of a product",
     *     description="Set a single property of a product.",
     *         @SWG\Parameter(
     *             name="ID",
     *             type="integer",
     *             in="path",
     *             required=true,
     *             description="The identifier of the product to update",
     *         ),
     *         @SWG\Parameter(
     *             name="property",
     *             type="string",
     *             in="path",
     *             required=true,
     *             description="The property of the product to update",
     *         ),
     *         @SWG\Parameter(
     *             name="value",
     *             type="string",
     *             in="formData",
     *             required=true,
     *             description="The value of the property of the product to update",
     *         ),
   *        @SWG\Response(
     *        response = 406,
     *        description = "Invalid parameter(s)",
     *       ),
     *       @SWG\Response(
     *        response = 405,
     *        description = "Method not allowed",
     *       ),
	 *		  @SWG\Response(
     *        response = 404,
     *        description = "Product not found",
     *       ),
	 *		  @SWG\Response(
     *        response = 200,
     *        description = "Success",
     *       ),
	 *        @SWG\Response(
     *        response = 400,
     *        description = "Missing parameter(s)"
     *       ),
	 *		 @SWG\Response(
     *        response = 500,
     *        description = "Something went wrong",
     *      ),
     *    )
     */
    public static function propertyPOST($request) {
        global $sudosos;
		if (count($request->CALL) < 1 || empty($request->STDINCONVERT)) {
            return result(400, "Missing parameter(s)");
        }
		
		if(!is_numeric($request->CALL[0])){
		return result(406, "Invalid parameter");
			}
        $id = $request->CALL[0];
        $property = $request->CALL[1];
        
        $value = $request->STDINCONVERT['value'];
		
        if ($property == "ID" || $property == "created_at" || $property == "updated_at" || $property == "deleted_at"){
			return result(405, "Method not allowed");
		}
	
        // We cannot directely use input for the column name in the prepared statement, so we use a layer for the column name.
        // If this would not return a valid result, column does not exist and we might be sql injected.
        $res = $sudosos->query("SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'sudosos' AND TABLE_NAME = 'product' AND COLUMN_NAME = ?", array($property));
		
        // Check that the results are valid
        if($res->ERROR || ($res->COUNT) !== 1){
            return result(406, "Property not found");
        }

        $result = $sudosos->query("UPDATE product SET `$property`=? WHERE ID=?", array($value, $id));
     
        if($result->ERROR) {
            return $result;
            return result(500, "Something went wrong");
        }
		
		if(($result->COUNT) !== 1){
			return result(404, "Product not found");
		}
        
        return result(200,"Success");

    }

	// DO NOT IMPLEMENT
    /**
     * @SWG\Get(
	 *	   tags={"product"},
     *     path="product/{id}/pricePolicy",
	 *	   summary="NOT IMPLEMENTED",
	 *	   description="NOT IMPLEMENTED",
     *         @SWG\Parameter(
     *             name="ID",
     *             type="string",
     *             in="path",
     *             required=true,
     *             description="The identifier of the product you want the price policy of",
     *         ),
	 *		@SWG\Response(
     *        response = 200,
	 *        description = "Success",
     *     ),
     * )
     */
    public static function pricePolicyGET($request) {
        return $request;
        // TODO content, return the result
    }
	
	 // DO NOT IMPLEMENT
    /**
     * @SWG\Post(
	 *	   tags={"product"},
     *     path="product/{id}/pricePolicy",
	 *	   summary="NOT IMPLEMENTED",
     *     description="NOT IMPLEMENTED",
     *         @SWG\Parameter(
     *             name="ID",
     *             type="string",
     *             in="path",
     *             required=true,
     *             description="The identifier of the product you want the price policy of",
     *         ),
     *         @SWG\Parameter(
     *             name="value",
     *             type="integer",
     *             in="formData",
     *             required=true,
     *             description="The actual price policy to set",
     *         ),
	 *		@SWG\Response(
     *        response = 200,
	 *        description = "Success",
     *     ),
     * )
     */
    public static function pricePolicyPOST($request) {
        return $request;
        // TODO content, return the result
    }
	
	
	
}

?>
