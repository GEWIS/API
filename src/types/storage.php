<?php

/*
 * @SWG\Resource(
 *     basePath="https://api.gewis.nl/",
 *     resourcePath="storage",
 * )
 */
 
 /**
 * @SWG\Definition(
 *   definition="storage",
 *      required={"ID","name","ownerID","created_at","updated_at","deleted_at"},
 *		 @SWG\Property(
 *             property="ID",
 *             type="integer",
 *             description="The identifier of the storage"
 *         ), @SWG\Property(
 *             property="name",
 *             type="string",
 *             description="The name of the storage"
 *         ), @SWG\Property(
 *             property="ownerID",
 *             type="integer",
 *             description="The ownerID of the storage"
 *         ), @SWG\Property(
 *             property="created_at",
 *             description="The timestamp the storage is created",
 *             type="timestamp",
 *         ), @SWG\Property(
 *             property="updated_at",
 *             type="timestamp",
 *             description="The timestamp the storage is updated"
 *         ),@SWG\Property(
 *             property="deleted_at",
 *             type="timestamp",
 *             description="The timestamp the storage is deleted"
 *    	 ),
 *	),
 */
 
 /**
 * @SWG\Definition(
 *   definition="inputStorage",
 *      required={"name","ownerID"},
 *			 @SWG\Property(
 *             property="name",
 *             type="string",
 *              description="The name of the storage"
 *         ), @SWG\Property(
 *             property="ownerID",
 *             type="integer",
 *             description="The ownerID of the storage"
 *         ),
 *	),
 */
 
 /**
 * @SWG\Definition(
 *   definition="postStorage",
 *      required={"ID","name","ownerID"},
 *			  @SWG\Property(
 *             property="ID",
 *             type="integer",
 *             description="The identifier of the storage"
 *         ),
 *			 @SWG\Property(
 *             property="name",
 *             type="string",
 *             description="The name of the storage"
 *         ), @SWG\Property(
 *             property="ownerID",
 *             type="integer",
 *             description="The ownerID of the storage"
 *         ),
 *	),
 */
 
 
class storage {
	
	/**
     * @SWG\Get(
	 *	   tags={"storage"},
     *     path="storage/",
	 *	   summary="Gets all storages",
	 *	   description= "Returns all storages",  
	 *	 @SWG\Response(
     *       response = 500,
     *       description = "Something went wrong",
     *        ),
     *   @SWG\Response(
     *      response = 200,
     *      description = "Success",
     *   	@SWG\Schema(type="array", @SWG\Items(ref="#/definitions/storage")),
     *      ),
     *    )
     */
	 
    /**
     * @SWG\Get(
     *     path="storage/{id}",
	 *	   summary="Get a storage",
	 *	   tags={"storage"},
	 *	   description= "Returns the storage for given ID",
     *    @SWG\Parameter(
	 *		   name="ID", 	
     *         type="integer",     
     *         in="path",
     *         required=false,
     *         description="The identifier of the storage to query",
     *         ),
	 *		  @SWG\Response(
     *        response = 500,
     *        description = "Something went wrong",
     *      ),
	 * 		@SWG\Response(
     *      response = 200,
     *      description = "Success",
     *   @SWG\Schema(ref="#/definitions/storage"),
     *      ),
     *    ),
     */
	public static function defaultGET($request){
		global $sudosos;

        if(!isset($request->CALL[0])){
			// Return all.
            $result = $sudosos->query("SELECT * FROM storage",array(null), PDO::FETCH_ASSOC);
            if($result->ERROR){
                return result(500, "Something went wrong");
            }
            return $result->RESULT;
            
        } else {		
			if(!is_numeric($request->CALL[0]) || $request->CALL[0] < "0" || is_null($request->CALL[0])){
			return result(406, "Invalid parameter"); 
			}
			
            $result = $sudosos->query("SELECT * FROM storage WHERE id=?", array($request->CALL[0]), PDO::FETCH_ASSOC);

			if($result->ERROR){
                return result(500, "Something went wrong");
            }
			
            if(count($result->RESULT) !== 1){
                return result(404, "Storage not found");
            }

            return $result->RESULT[0];
        }
	}
	
	 /**
     * @SWG\Post(
     *     tags={"storage"},
     *     path="storage/",
     *     summary="Create a storage",
     *     @SWG\Parameter(
	 *		   name="storage", 
     *         in="body",
     *         type="inputstorage",
     *         parameter="body",
     *         required=true,
     *         description="Model of the storage to store",
	 *		@SWG\Schema(ref="#/definitions/inputStorage"),
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
     *     )
     */
    public static function defaultPOST($request) {
        global $sudosos;
        $json = $request->STDINCONVERT;
        $name = $json['name'];
        $ownerID = $json['ownerID'];
		
        if(!isset($name) || !isset($ownerID)){
            return result(406, "Missing parameter(s)");
        }
		if(!is_numeric($ownerID) || $ownerID < 0){
			return result(406, "Invalid parameter(s)");
		}
		
        $result = $sudosos->query("INSERT INTO storage (name,ownerID)
            VALUES (?, ?)", array($name,$ownerID));
			
		if($result->COUNT !== 1){
			return result(404, "Owner not found");
		}
        if($result->ERROR){
            return result(500, "Something failed");
        }
        
        return result(200, "Success");
    }
	
	/**
     * @SWG\Put(
	 *	   tags={"storage"},
     *     path="storage/{id}",
	 *	   summary="Update the whole storage",
     *     description="Update storage using the storage model definition.",
     *         @SWG\Parameter(
     *            name="Storage",
     *            in="body",
     *            parameter="body",
     *            type="storage",
     *            required=true,
     *            description="The model of the storage to update.",
     *            @SWG\Schema(ref="#/definitions/postStorage"),
     *         ),
	 *       @SWG\Response(
     *        response = 406,
     *        description = "Missing parameter(s) / Invalid parameter(s)",
     *       ),@SWG\Response(
     *        response = 404,
     *        description = "Storage not found",
	 *		 ),@SWG\Response(
     *        response = 200,
     *        description = "Success",
	 *		),
     * )
     */
	public static function defaultPUT($request){
		global $sudosos;
        $json = $request->STDINCONVERT;
		$id = $json['ID'];
        $name = $json['name'];
        $ownerID = $json['ownerID'];
		
        if(!isset($name) || !isset($ownerID) || !isset($id)){
            return result(406, "Missing parameter(s)");
        }
		if(!is_numeric($id) || !is_numeric($ownerID) || $id < 0 || $ownerID < 0){
			return result(406, "Invalid parameter(s)");
		}
		
        $result = $sudosos->query("UPDATE storage SET name = ?, ownerID=? WHERE ID=?", array($name,$ownerID,$id));
			
		if($result->COUNT !== 1){
			return result(404, "Storage or owner does not exist");
		}
        if($result->ERROR){
            return result(500, "Something failed");
        }
        
        return result(200, "Success");
	}
	
	 /**
     * @SWG\Delete(
	 *	   tags={"storage"},
     *     path="storage/{id}/",
	 *	   summary="Disable a given storage",
	 *	   description="Disables the given storage",
     *     @SWG\Parameter( 
     *             name="ID",
     *             type="integer",
     *             in="path",
     *             required=true,
     *             description="The ID of the storage to disable",
	 *		),
	 *		@SWG\Response(
     *        response = 200,
	 *        description = "Success",
     *     ),
	 *		@SWG\Response(
     *        response = 404,
     *        description = "Storage not found",
	 *		 ),
	 *		 @SWG\Response(
     *        response = 406,
     *        description = "Invalid parameter",
	 *		 ),
	 *		 @SWG\Response(
     *        response = 409,
     *        description = "Storage already disabled",
	 *		 ),
	 *		 @SWG\Response(
     *        response = 500,
     *        description = "Something went wrong",
     *      ),
     * )
     */
    public static function defaultDELETE($request){
        global $sudosos;
	     
		if(!is_numeric($request->CALL[0]) || $request->CALL[0] < "0"){
			return result(406, "Invalid parameter");
		}
            
        $id = $request->CALL[0];
		
		$result = $sudosos->query("SELECT deleted_at FROM storage WHERE id=?", array($id));
		
		if(($result->COUNT) !== 1){
			return result(404,"Storage not found");
		}
		
		if(!is_null($result->RESULT[0][0])){
			return result(409, "Storage already disabled");
		}
		
		$timestamp = date('Y-m-d G:i:s');
        $res = $sudosos->query("UPDATE storage SET deleted_at=?  WHERE ID=? AND deleted_at is null", array($timestamp,$id));
     
		if($res->ERROR){
			return result(500, "Something went wrong");
		}	
		return result(200, "Success");
    }
	
	 /**
     * @SWG\Post(
	 *	   tags={"storage"},
     *     path="storage/{id}/reinstate/",
     *     summary="Reinstates a storage",
     *     description="Reinstates the given storage.",    
     *         @SWG\Parameter(
     *             name="id",
     *             type="integer",
     *             in="path",
     *             required=true,
     *             description="The identifier of the storage to reinstate",
     *         ),
	 *		 @SWG\Response(
     *        response = 406,
     *        description = "Invalid parameter",
     *       ),@SWG\Response(
     *        response = 404,
     *        description = "Storage not found",
	 *		 ),@SWG\Response(
     *        response = 200,
     *        description = "Success",
	 *		),@SWG\Response(
     *        response = 500,
     *        description = "Something went wrong",
     *      ), @SWG\Response(
     *        response = 409,
     *        description = "Storage already active",
	 *		 ),
     *     )
     */
    public static function reinstatePOST($request) {
        global $sudosos;
        			
		if(!is_numeric($request->CALL[0]) || $request->CALL[0] < "0"){
            return result(406 ,"Invalid parameter");
        } 
		  
        $id = $request->CALL[0];
      	$result = $sudosos->query("SELECT deleted_at FROM storage WHERE id=?", array($id));
		
		if(($result->COUNT) !== 1){
			return result(404,"Storage not found");
		}
		
		if(is_null($result->RESULT[0][0])){
			return result(409, "Storage is already active");
		}
		
        $result = $sudosos->query("UPDATE storage SET deleted_at=?  WHERE id=? AND deleted_at is not null", array(null,$id));
     
		if($result->ERROR){
			return result(500, "Something went wrong");
		}	
		
		return result(200, "Success");
    }
		
	/**
     * @SWG\Get(
	 *	   tags={"storage"},
     *     path="storage/{id}/{property}",
	 *	   summary="Get a property of a storage",
     *     description="Get property of given storage.",
     *         @SWG\Parameter(
     *             name="ID",
     *             type="integer",
     *             in="path",
     *             required=true,
     *             description="The identifier of the storage to query",
	 *			),
     *         @SWG\Parameter(
     *             name="property",
     *             type="string",
     *             in="path",
     *             required=true,
     *             description="The property of the storage to query",
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
	 *        description = "Storage not found",
     *     ),
	 *	@SWG\Response(
     *        response = 405,
	 *        description = "Method not allowed",
     *     ),
	 *	)
     */
    public static function propertyGET($request) {
        global $sudosos;
  
		if (count($request->CALL) < 1) {
            return result(400, "Missing parameter(s)");
        }
		
		if(!is_numeric($request->CALL[0]) || $request->CALL[0] < "0"){
		return result(406, "Invalid parameter");
			}
		
        $id = $request->CALL[0];
        $property = $request->CALL[1];
        
        $result = $sudosos->query("SELECT * FROM storage WHERE id=?", array($id));
        
        if ($result->ERROR){
            return result(500, "Something went wrong");
		}
        if (count($result->RESULT) !== 1){
            return result(404, "Storage not found");
		}	
        $pos = $result->RESULT[0];

        if (!array_key_exists($property, $pos)){
            return result(405, "Method not allowed");
		}
        return $pos[$property];
    }
	   
	 /**
     * @SWG\Post(
	 *	   tags={"storage"},
     *     path="storage/{id}/{property}",
	 *	   summary="Set a property of a storage",
     *     description="Set a single property of a storage.",
     *         @SWG\Parameter(
     *             name="ID",
     *             type="integer",
     *             in="path",
     *             required=true,
     *             description="The identifier of the storage to update",
     *         ),
     *         @SWG\Parameter(
     *             name="property",
     *             type="string",
     *             in="path",
     *             required=true,
     *             description="The property of the storage to update",
     *         ),
     *         @SWG\Parameter(
     *             name="value",
     *             type="string",
     *             in="formData",
     *             required=true,
     *             description="The value of the property of the storage to update",
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
     *        description = "Storage not found",
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
		
		if(!is_numeric($request->CALL[0])|| $request->CALL[0] < 0){
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
        $res = $sudosos->query("SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'sudosos' AND TABLE_NAME = 'storage' AND COLUMN_NAME = ?", array($property));
		
        // Check that the results are valid
        if($res->ERROR || ($res->COUNT) !== 1){
            return result(406, "Property not found");
        }

        $result = $sudosos->query("UPDATE storage SET `$property`=? WHERE ID=?", array($value, $id));
     
        if($result->ERROR) {
            return result(500, "Something went wrong");
        }
		
		if(($result->COUNT) !== 1){
			return result(404, "Storage not found");
		}
        
        return result(200,"Success");
    }
	
	/**
     * @SWG\Get(
     *     path="storage/{id}/stores",
     *     summary="Get the products that are stored in a storage",
     *     tags={"storage"},
     *     @SWG\Parameter(
     *             name="ID",
     *             type="integer",
     *             in="path",
     *             required=true,
     *             description="The identifier of the storage to retrieve the stored products from",
     *         ),
     *       @SWG\Response(
     *        response = 406,
     *        description = "Invalid parameter",
     *       ),
     *       @SWG\Response(
     *        response = 500,
     *        description = "Something went wrong",
     *       ),
     *       @SWG\Response(
     *        response = 200,
     *        description = "Success",
     *     ),
	 *		@SWG\Response(
     *        response = 404,
     *        description = "Storage is not found",
	 * 		),
     * )
     */
    public static function storesGET($request){
		global $sudosos;
        if (!isset($request->CALL[0]) || is_null($request->CALL[0])) {
            return result(400, "Missing parameter.");
        }
					
        if(!is_numeric($request->CALL[0]) || ($request->CALL[0]) < "0"){
            return result(406, "Invalid parameter");
        }
        $id = $request -> CALL[0];
		
		$result = $sudosos->query("select ID from storage where ID= ?", array($id), PDO::FETCH_ASSOC);
		if ($result->ERROR){
            return result(500, "Something went wrong");
		}
        if (count($result->RESULT) !== 1){
            return result(404, "Storage not found");
		}	
							
        $result1 = $sudosos->query("select productID,stock from productStorage where storageID = ?", array($id), PDO::FETCH_ASSOC);

	
		
        if ($result1->ERROR){
            return result(500, "Something went wrong");
		}
		
		return $result1->RESULT;
            
	}  
		   	 
	/**
     * @SWG\Post(
     *     tags={"storage"},
     *     path="storage/{storageID}/stores/{productID}",
     *     summary="Store a product in a storage",
	 *	   description="Store a product in given storage",
     *     @SWG\Parameter(
	 *		   name="storageID", 
     *         in="path",
     *         type="integer",     
     *         required=true,
     *         description="The identifier of the storage",
     *         ),
	 *		 @SWG\Parameter(
	 *		   name="productID", 
     *         in="path",
     *         type="integer",     
     *         required=true,
     *         description="The identifier of the product",
     *         ),
	 *		 @SWG\Parameter(
	 *		   name="stock", 
     *         in="formData",
     *         type="integer",     
     *         required=true,
     *         description="Stock of particular product in the storage",
	 *		), 
	*		 @SWG\Response(
     *        response = 200,
	 *        description = "Success",
     *     ),
	 *		@SWG\Response(
     *        response = 400,
	 *        description = "Missing parameter(s)",
     *     ),
	 *		@SWG\Response(
     *        response = 406,
	 *        description = "Invalid parameter(s)",
     *     ), 
     *  	@SWG\Response(
     *        response = 404,
	 *        description = "Storage not found / Product not found",
     *     ),
	 *		@SWG\Response(
     *        response = 500,
	 *        description = "Something failed",
     *     ),
	 *      @SWG\Response(
     *        response = 409,
     *        description = "Product was already stored in the storage / Product is not active",
	 *		 ),
	 *  )
	 */
	 public static function storesPOST($request){
		global $sudosos;
		if (count($request->CALL) < 2 || count($request->POST) < 1) {
            return result(400, "Missing parameter(s)");
        }
		
		if(!is_numeric($request->CALL[0]) ||!is_numeric($request->CALL[1]) || !is_numeric($request->POST["stock"]) || 
			$request->CALL[0] < "0" || $request->CALL[1] < "0" || $request->POST["stock"] < "0"){
		return result(406, "Invalid parameter(s)");
			}
		
        $storageID = $request->CALL[0];
		$productID = $request->CALL[1];
        $stock = $request->POST["stock"];
		
		$res = $sudosos->query("SELECT ID from storage WHERE ID=?", array($storageID));
		if ($res->ERROR){
            return result(500, "Something went wrong");
		}
        if (count($res->RESULT) !== 1){
            return result(404, "Storage not found");
		}	
		
		$res2 = $sudosos->query("SELECT ID,deleted_at from product WHERE ID=?", array($productID));
		if ($res2->ERROR){
            return result(500, "Something went wrong");
		}
		
        if (count($res2->RESULT) !== 1){
            return result(404, "Product not found");
		}	
		if ($res2->ERROR){
            return result(500, "Something went wrong");
		}
		if($res2-> RESULT[0]["deleted_at"]){
			return result(409, "Product is not active");
		}
		
		$res3 = $sudosos->query("SELECT * from productStorage WHERE productID=? AND storageID=?", array($productID,$storageID));
		if ($res3->ERROR){
            return result(500, "Something went wrong");
		}
        if (count($res3->RESULT) > 0){
            return result(409, "Product was already stored in the storage");
		}
		
		$res4 = $sudosos->query("INSERT INTO productStorage (productID,storageID,stock) VALUES (?,?,?)", array($productID,$storageID,$stock));
			
		if($res4->ERROR){
            return result(500, "Something failed");
        }	
		  
        return result(200, "Success");
	 }
	 
	 /**
     * @SWG\Delete(
     *     tags={"storage"},
     *     path="storage/{storageID}/stores/{productID}",
     *     summary="Remove a product in a storage",
	 *	   description="Removes a given product in a given storage",
     *     @SWG\Parameter(
	 *		   name="storageID", 
     *         in="path",
     *         type="integer",     
     *         required=true,
     *         description="The identifier of the storage",
     *         ),
	 *	   @SWG\Parameter(
	 *		   name="productID", 
     *         in="path",
     *         type="integer",     
     *         required=true,
     *         description="The identifier of the product",
     *         ),
	 *	   @SWG\Response(
     *        response = 200,
	 *        description = "Success",
     *     ),
	 *	   @SWG\Response(
     *        response = 400,
	 *        description = "Missing parameter(s)",
     *     ),
	 *	   @SWG\Response(
     *        response = 406,
	 *        description = "Invalid parameter(s)",
     *     ), 
	 *	   @SWG\Response(
     *        response = 500,
	 *        description = "Something failed",
     *     ),
	 *     @SWG\Response(
     *        response = 409,
     *        description = "Product is not stored in the storage",
	 *		 ),
	 *  )
	 */
	 public static function storesDELETE($request){
		global $sudosos;
		
		if (count($request->CALL) < 2) {
            return result(400, "Missing parameter(s)");
        }
		
		if(!is_numeric($request->CALL[0]) ||!is_numeric($request->CALL[1])  || 
			$request->CALL[0] < "0" || $request->CALL[1] < "0"){
		return result(406, "Invalid parameter(s)");
			}
		
        $storageID = $request->CALL[0];
		$productID = $request->CALL[1];
		
		$res = $sudosos->query("DELETE FROM productStorage WHERE storageID=? AND productID=?", array($storageID, $productID));
		if ($res->ERROR){
            return result(500, "Something went wrong");
		}
        if ($res->COUNT !== 1){
            return result(409, "Product is not stored in the storage");
		}
		  
        return result(200, "Success");
	 }
	 
}
?>