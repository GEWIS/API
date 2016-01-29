<?php
/*
/**
 * @SWG\Resource(
 *     basePath="https://api.gewis.nl/",
 *     resourcePath="pointOfSales",
 * )
*/

/**
 * @SWG\Definition(
 *      definition="pointOfSales",
 *      required={"date","name","ownerID"},
 *      @SWG\Property(
 *              property="ID",
 *              type="integer",
 *              description="Identifier of the Point of Sales"
 *      ),
 *      @SWG\Property(
 *             property="name",
 *             type="string",
 *             description="The name of the Point of Sales"
 *         ),
 *      @SWG\Property(
 *             property="ownerID",
 *             type="integer",
 *             description="Owner of the Point of Sales"
 *         ),
 *		 @SWG\Property(
 *             property="created_at",
 *             type="timestamp",
 *             description="Time of creation of the Point of Sales"
 *         ),
 *		  @SWG\Property(
 *             property="updates_at",
 *             type="timestamp",
 *             description="Time of last update of the Point of Sales"
 *         ),
 *		   @SWG\Property(
 *             property="deleted_at",
 *             type="timestamp",
 *             description="Time of 'deletion of the Point of Sales"
 *         ),
 *     )
 **/

/**
 * @SWG\Definition(
 *   definition="inputPointOfSales",
 *      required={"name","ownerID"},
 *      @SWG\Property(
 *             property="name",
 *             type="string",
 *             description="The name of the Point of Sales."
 *         ),
 *      @SWG\Property(
 *             property="ownerID",
 *             type="integer",
 *             description="Owner of the Point of Sales"
 *         ),
 *     )
 */
 
 /**
 * @SWG\Definition(
 *   definition="inputPointOfSalesID",
 *      required={"ID","name","ownerID"},
 *		@SWG\Property(
 *              property="ID",
 *              type="integer",
 *              description="Identifier of the Point of Sales"
 *      ),
 *      @SWG\Property(
 *             property="name",
 *             type="string",
 *             description="The name of the Point of Sales."
 *         ),
 *      @SWG\Property(
 *             property="ownerID",
 *             type="integer",
 *             description="Owner of the Point of Sales"
 *         ),
 *     )
 */
 


  

class pointOfSales{

	/**
     * @SWG\Get(
     *        path="pointOfSales/",
     *       summary="Get all Points Of Sales",
     *       tags={"POS"},
     *      description= "Returns all Points of Sales.",
     *
     *      @SWG\Response(
     *        response = 500,
     *        description = "Something went wrong",
     *       ),
     *      @SWG\Response(
     *      response = 200,
     *      description = "Success",
     *   @SWG\Schema(type="array", @SWG\Items(ref="#/definitions/pointOfSales")),
     * ),
	 *),
     */
	
	/**
     * @SWG\Get(
     *      tags={"POS"},
     *        path="pointOfSales/{id}",
     *        summary="Get a Point Of Sale",
     *         @SWG\Parameter(
     *             name="ID",
     *             in ="path",
     *             type="integer",
     *             required=true,
     *             description="The identifier of the Point of Sales to retrieve",
     *         ),
	 *		@SWG\Response(
     *        response = 200,
	 *        description = "Succes",
     *	      @SWG\Schema(ref="#/definitions/pointOfSales"),
     *       ),
     *       @SWG\Response(
     *        response = 500,
     *        description = "Something went wrong",
     *       ), 
	 *		@SWG\Response(
     *      response = 404,
     *      description = "Point of Sales not found",
     *       ), 
	 * 		@SWG\Response(
     *      response = 406,
     *      description = "Invalid parameter",
     *      ),
     * ),
     */
	  public static function defaultGET($request){
        global $sudosos;

        if (!isset($request->CALL[0])) {
            // Return all 
            $result = $sudosos->query("select * from pointOfSales", array(), PDO::FETCH_ASSOC);
            if ($result->ERROR){
                return result(500, "Something went wrong");
            }else{
                return $result->RESULT;
			}
		}else {
            $id = $request->CALL[0];
            if (!is_numeric($id) || $id < 0){
                return result(406, "Invalid parameter");
            } else {
                $result = $sudosos->query("select * from pointOfSales where id=?", array($id), PDO::FETCH_ASSOC);
                if (count($result->RESULT) !== 1){
                    return result(404, "Point of Sales not found");
				}
                if ($result->ERROR){
                    return result(500, "Something went wrong");
				} else {
                    return $result->RESULT[0];
				}
			}
		}
	}
	 
    /**
     * @SWG\Post(
     *       tags={"POS"},
     *       path="pointOfSales/",
     *       summary="Creates a Point of Sales",
     *       @SWG\Parameter(
     *            name="POS",
     *            in="body",
     *            parameter="body",
     *            type="inputPointOfSales",
     *            required=true,
     *            description="The model of the Point of Sales to store.",
     *            @SWG\Schema(ref="#/definitions/inputPointOfSales"),
     *         ),
     *       @SWG\Response(
     *          response = 200,
     *          description = "Success",
     *      ),@SWG\Response(
     *          response = 406,
     *          description = "Invalid parameter",
     *      ),@SWG\Response(
     *          response = 404,
     *          description = "Owner not found",
     *      ),@SWG\Response(
     *        response = 400,
	 *        description = "Missing parameter(s)",
     *     ), @SWG\Response(
     *        response = 500,
     *        description = "Something went wrong",
     *       ), 
     *    )
     */
    public static function defaultPOST($request){	
        global $sudosos;
		
		$json = $request->STDINCONVERT;
        $name = $json['name'];		
		$ownerID = $json['ownerID'];
		if(!isset($name) || !isset($ownerID)){
			return result(400, "Missing parameter(s)");
		}
		if(!is_numeric($ownerID) || $ownerID < 0){
			return result(406,"Invalid parameter");
		}
		
		$res = $sudosos->query("SELECT * FROM users WHERE ID=?", array($ownerID));
		 if ($res->ERROR) {
            return result(500, "Something went wrong");
        }
		if($res->COUNT !== 1){
			return result(404, "Owner not found");
        }
		$timestamp = date('Y-m-d G:i:s');
		
        $res2 = $sudosos->query("INSERT into pointOfSales(`name`,`ownerID`) values(?, ?)", array($name, $ownerID));
        if ($res2->ERROR) {
            return result(500, "Something went wrong");
        } 
		return result(200, "Success");
    }
	
	 /**
     * @SWG\Put(
     *     path="pointOfSales/{id}",
     *     summary="Update an entire Point of Sales",
     *     tags={"POS"},
     *        @SWG\Parameter(
     *            name="POS",
     *            in="body",
     *            parameter="body",
     *            type="PointOfSales",
     *            required=true,
     *            description="The model of the Point of Sales to update.",
     *            @SWG\Schema(ref="#/definitions/inputPointOfSalesID"),
     *         ),
     *        @SWG\Response(
     *        response = 406,
     *        description = "Invalid parameter(s)",
     *       ),@SWG\Response(
     *        response = 404,
     *        description = "Point of Sales not found / Owner not found",
	 *		 ),@SWG\Response(
     *        response = 200,
     *        description = "Success",
	 *		),@SWG\Response(
     *        response = 400,
     *        description = "Missing parameter(s)",
     *       ),@SWG\Response(
     *        response = 500, 
     *        description = "Something went wrong",
     *       ),
     *   )
     */
	 public static function defaultPUT($request){
        global $sudosos;
		$json = $request->STDINCONVERT;
		$id = $json['ID'];
        $name = $json['name'];		
		$ownerID = $json['ownerID'];
		if(!isset($name) || !isset($ownerID) || !isset($id)){
			return result(400, "Missing parameter(s)");
		}
		
		if(!is_numeric($ownerID) || !is_numeric($id) || $id < 0 || $ownerID < 0){
			return result(406, "Invalid parameter(s)");
		}
		
		$res = $sudosos->query("SELECT * FROM pointOfSales where ID = ?", array($id));
			if ($res->ERROR) {
            return result(500, "Something went wrong");
			}
			if($res->COUNT!= 1){
			return result(404, "Point of Sales not found");
			}
			
		$res2 = $sudosos->query("SELECT * FROM users WHERE ID = ?", array($ownerID));
			if ($res2->ERROR) {
            return result(500, "Something went wrong");
			}
			if($res2->COUNT!= 1){
			return result(404, "Owner not found");
			}
		
		$timestamp = date('Y-m-d G:i:s');
        $result = $sudosos->query("UPDATE `pointOfSales` SET `name`=? , `ownerID`=? where `ID`=?", array($name, $ownerID, $id));
        if ($result->ERROR) {
            return result(500, "Something went wrong");
        } 
		return result(200, "Success");
	 }
	 
	/**
     * @SWG\Delete(
     *       path="pointOfSales/{id}",
     *       summary="Disables this Point of Sales",
     *       tags={"POS"},
     *             @SWG\Parameter(
     *             name="ID",
     *             type="integer",
     *             in="path",
     *             required=true,
     *             description="The identifier of the Point of Sales to disable",
     *         ),
     *  	  @SWG\Response(
     *        response = 406,
     *        description = "Invalid parameter",
     *       ),
     *        @SWG\Response(
     *        response = 500,
     *        description = "Something went wrong",
     *       ),
     *        @SWG\Response(
     *        response = 200,
     *        description = "Point of Sales is disabled",
     *     	 ),
	 *		  @SWG\Response(
	 *		  response = 404,
	 *		  description= "Point of Sales not found",
     * 	     ),
	 *        @SWG\Response(
     *        response = 409,
     *        description = "Point of Sales already disabled",
	 *	     ),
	 *		  @SWG\Response(
     *        response = 400,
	 *        description = "Missing parameter",
     *     ),
	 *	)
     */
    public static function defaultDELETE($request){
	global $sudosos;
     
		if(!isset($request->CALL[0])){
			return result (400,"Missing parameter");
		}
		if(!is_numeric($request->CALL[0]) || $request->CALL[0] < "0"){
			return result(406, "Invalid parameter");
		}
            
        $id = $request->CALL[0];
		
		$result = $sudosos->query("SELECT deleted_at FROM pointOfSales WHERE id=?", array($id));
		
		if(($result->COUNT) !== 1){
			return result(404,"Point of Sales not found");
		}
		
		if(!is_null($result->RESULT[0][0])){
			return result(409, "Point of Sales already disabled");
		}
		
		$timestamp = date('Y-m-d G:i:s');
        $result = $sudosos->query("UPDATE pointOfSales SET deleted_at=?  WHERE ID=? AND deleted_at is null", array($timestamp,$id));
     
		if($result->ERROR){
			return result(500, "Something went wrong");
		}	
		return result(200, "Point of Sales is disabled");
	}
	
	 /**
     * @SWG\Post(
     *      path="pointOfSales/{id}/reinstate",
	 *      tags={"POS"},
     *      summary="Reinstate this Point of Sales",
     *     @SWG\Parameter(
     *             name="ID",
     *             type="integer",
     *             in="path",
     *             required=true,
     *             description="The identifier of the Point of Sales to be reinstated",
     *      ),
	 *		 @SWG\Response(
     *        response = 406,
     *        description = "Invalid parameter",
     *      ),@SWG\Response(
     *        response = 404,
     *        description = "Point of Sales not found",
	 *		),@SWG\Response(
     *        response = 200,
     *        description = "Point of Sales is active",
	 *		),@SWG\Response(
     *        response = 500,
     *        description = "Something went wrong",
     *      ),@SWG\Response(
     *        response = 409,
     *        description = "Point of Sales already active",
	 *		),@SWG\Response(
     *        response = 400,
	 *        description = "Missing parameter",
     *     ),
     *   )
     */
    public static function reinstatePOST($request){
        global $sudosos;
        			
		if(!isset($request->CALL[0])){
			return result (400,"Missing parameter");
		}
		
		if(!is_numeric($request->CALL[0]) || $request->CALL[0] < "0"){
            return result(406 ,"Invalid parameter");
        } 
		
        $id = $request->CALL[0];
      	$result = $sudosos->query("SELECT deleted_at FROM pointOfSales WHERE id=?", array($id));
		if($result->ERROR){
			return result(500, "Something went wrong");
		}	
		
		if(($result->COUNT) !== 1){
			return result(404,"Point of Sales not found");
		}
		
		if(is_null($result->RESULT[0][0])){
			return result(409, "Point of Sales already active");
		}
		
        $result = $sudosos->query("UPDATE pointOfSales SET deleted_at=?  WHERE id=? AND deleted_at is not null", array(null,$id));
     
		if($result->ERROR){
			return result(500, "Something went wrong");
		}	
		return result(200, "Point of Sales is active");
    }
	
    /**
     * @SWG\Get(
     *     path="pointOfSales/{id}/{property}",
     *     summary="Get a property of a Point of Sales",
     *    tags={"POS"},
     *         @SWG\Parameter(
     *             name="ID",
     *             type="integer",
     *             in="path",
     *             required=true,
     *             description="The identifier from the Point of Sales you want information of",
     *         ),
     *         @SWG\Parameter(
     *             name="property",
     *             type="string",
     *             in="path",
     *             required=true,
     *             description="The property of the Point of Sales you request",
     *         ),
     *     @SWG\Response(
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
	 *        description = "Point of Sales not found",
     *     ),
	 *	@SWG\Response(
     *        response = 405,
	 *        description = "Method not allowed",
     *     ),
     *   )
     */
    public static function propertyGET($request){

        global $sudosos;
        if (!isset($request->CALL[0]) || !isset($request->CALL[1]) || is_null($request->CALL[0]) || is_null($request->CALL[1])){
            return result(400, "Missing parameter(s)");
		}
		
		 if(!is_numeric($request->CALL[0]) || $request->CALL[0]< "0"){
            return result(406, "Invalid parameter");
        }
		
        $id = $request->CALL[0];
        $property = $request->CALL[1];
			
        $result = $sudosos->query("SELECT * FROM pointOfSales where id=?", array($id), PDO::FETCH_ASSOC);
        if ($result->ERROR){
            return result(500, "Something went wrong");
		}
        if (count($result->RESULT) !== 1){
            return result(404, "Point of Sales not found");
		}	
        $pos = $result->RESULT[0];

        if (!array_key_exists($property, $pos)){
            return result(405, "Method not allowed");
		}
        return $pos[$property];
		return result(200, "Success");
    }

    /**
     * @SWG\Post(
     *     path="pointOfSales/{id}/{property}",
     *     summary="Set a property of a Point of Sales",
     *       tags={"POS"},
     *         @SWG\Parameter(
     *             name="ID",
     *             type="string",
     *             in="path",
     *             required=true,
     *             description="The identifier of the Point of Sales to update",
     *         ),
     *         @SWG\Parameter(
     *             name="property",
     *             type="string",
     *             in="path",
     *             required=true,
     *             description="The property of the Point of Sales to update",
     *         ),
     *         @SWG\Parameter(
     *             name="value",
     *             type="string",
     *             in="formData",
     *             required=true,
     *             description="The value of the property of the Point of Sales to update",
     *         ),
     *      @SWG\Response(
     *        response = 406,
     *        description = "Invalid parameter",
     *       ),
     *      @SWG\Response(
     *        response = 405,
     *        description = "Method not allowed",
     *       ),
	 *		@SWG\Response(
     *        response = 404,
     *        description = "Point of Sales not found.",
     *      ),
	 *		@SWG\Response(
     *        response = 200,
     *        description = "Success",
     *     ), 
	 *		@SWG\Response(
     *        response = 400,
     *        description = "Missing parameter(s)"
     *       ),
     *   )
     */
    public static function propertyPOST($request){
        global $sudosos;
        if (count($request->CALL) < 1 || empty($request->STDINCONVERT)) {
            return result(400, "Missing parameter(s)");
        }
		
		if(!is_numeric($request->CALL[0]) || $request->CALL[0] < "0"){
		return result(406, "Invalid parameter");
			}
	
        $id = $request->CALL[0];
        $property = $request->CALL[1];

        $value = $request->STDINCONVERT["value"];
	
		if ($property == "ID" || $property == "created_at" || $property == "updated_at" || $property == "deleted_at"){
			return result(405, "Method not allowed");
		}
        // We cannot directly use input for the column name in the prepared statement, so we use a layer for the column name.
        // If this would not return a valid result, column does not exist and we might be sql injected.
        $res = $sudosos->query("SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'sudosos' AND TABLE_NAME = 'pointOfSales' AND COLUMN_NAME = ?", array($property));
		
        // Check that the results are valid
        if ($res->ERROR || count($res->RESULT) !== 1)
            return error(405, "Method not allowed");

        $result = $sudosos->query("UPDATE pointOfSales SET `$property`=? WHERE id=?", array($value, $id));
		if ($result->ERROR) {
            return result(500, "Something went wrong");
        }
		if($result->COUNT!= 1){
			return result(404, "Point of Sales not found");
		}
		return result(200, "Succes");
     }
	 
	 	 /**
     * @SWG\Get(
     *     path="pointOfSales/{id}/products",
     *     summary="Get the products for a given Point of Sales",
     *     tags={"POS"},
     *     @SWG\Parameter(
     *             name="ID",
     *             type="integer",
     *             in="path",
     *             required=true,
     *             description="The identifier of the Point of Sales to retrieve the products from",
     *         ),
     *       @SWG\Response(
     *        response = 406,
     *        description = "Invalid parameter",
     *     ),
     *       @SWG\Response(
     *        response = 500,
     *        description = "Something went wrong",
     *     ),
	 *		 @SWG\Response(
     *       response = 400,
	 *       description = "Missing parameter",
     *     ),
	 *		 @SWG\Response(
     *       response = 404,
	 *       description = "Point of Sales not found",
     *     ),@SWG\Response(
     *       response = 200,
	 *		 description= "Success",
	 *		 @SWG\Schema(type="array", @SWG\Items(ref="#/definitions/product")),
	 *    ),	 
     * )
     */
    public static function productsGET($request){
		global $sudosos;

        if (!isset($request->CALL[0]) || is_null($request->CALL[0])) {
            return result(400, "Missing parameter");
        }
        if(!is_numeric($request->CALL[0]) || $request->CALL[0] < "0"){
            return result(406, "Invalid parameter");
        }
        $id = $request -> CALL[0];
		
		$result = $sudosos->query("SELECT * FROM pointOfSales WHERE ID=?", array($id));
		if($result->ERROR){
			return result(500, "Something went wrong");
		}	
		
		if(($result->COUNT) !== 1){
			return result(404,"Point of Sales not found");
		}

		$query = "select * from product where ID in 
					(select productID from productStorage where storageID in 
						(select storageID from storagePointOfSales where pointOfSalesID=?))";
        $result = $sudosos->query($query, array($id), PDO::FETCH_ASSOC);

        if ($result->ERROR){
            return result(500, "Something went wrong");
		}
		return $result->RESULT;
	}
	 
	/**
     * @SWG\Get(
     *     path="pointOfSales/{id}/sells",
     *     summary="Get all storages which are being sold through a Point of Sales",
     *    tags={"POS"},
     *         @SWG\Parameter(
     *             name="ID",
     *             type="integer",
     *             in="path",
     *             required=true,
     *             description="The identifier of the Point of Sales you want the storages of",
     *       ),
     *       @SWG\Response(
     *       response = 406,
     *       description = "Invalid parameter",
     *       ),
     *       @SWG\Response(
     *       response = 500,
     *       description = "Something went wrong",
     *       ),
	 *		@SWG\Response(
     *      response = 404,
     *      description = "Point of Sales not found",
     *      ),  
     *  	@SWG\Response(
     *      response = 200,
     *      description = "Success",
     *      @SWG\Schema(type="array", @SWG\Items(ref="#/definitions/storage")),
     *	 	),@SWG\Response(
     *      response = 400,
     *      description = "Missing parameter(s)",
     *       ),
	 *	 	)
     */
    public static function sellsGET($request){
        global $sudosos;
		if(!isset($request->CALL[0])){
			return result(400, "Missing parameter");
		}
		if(!is_numeric($request->CALL[0]) || $request->CALL[0] < "0"){
			return result(406, "Invalid parameter");
		}
		$id = $request->CALL[0];
		
		$result = $sudosos->query("select * from pointOfSales where ID=?", array($id));
		if($result->ERROR){
			return result(500, "Something went wrong");
		}	
		if($result->COUNT !== 1){
			return result(404, "Point of Sales not found");
		}
		$query =  "select * from storage where ID in 
					(select storageID from storagePointOfSales where pointOfSalesID =?)"; 	    
		$res2 = $sudosos->query($query, array($id), PDO::FETCH_ASSOC);
		
		if($res2->ERROR){
			return result(500, "Something went wrong");
		}	
		return $result->RESULT;	
	 }
	 
	  /**
     * @SWG\Post(
     *     path="pointOfSales/{posID}/sells/{storageID}",
     *     summary="Sell a storage through a Point of Sales",
     *     tags={"POS"},
     *           @SWG\Parameter(
     *           name="posID",
     *           type="integer",
     *           in="path",
     *           required=true,
     *           description="The identifier of the Point of Sales you want to sell from",
     *         ),@SWG\Parameter(
     *           name="storageID",
     *           type="integer",
     *           in="path",
     *           required=true,
     *           description="The identifier of the storage you want to sell products out",
     *         ),
     *        @SWG\Response(
     *        response = 406,
     *        description = "Invalid parameter(s)",
     *      ),@SWG\Response(
	 *		  response=404,
	 *	      description= "Point of Sales not found / Storage not found",
     *     ),@SWG\Response(
     *        response = 400,
     *        description = "Missing parameter(s)",
     *     ),@SWG\Response(
     *        response = 409,
     *        description = "Storage is already being sold from the Point of Sales",
     *      ),
	 *  ),
     */
	 public static function sellsPOST($request){
        global $sudosos;
		if(!isset($request->CALL[0]) || !isset($request->CALL[1])){
			return result(400, "Missing parameter(s)");
		}
		
		if (!is_numeric($request->CALL[0]) || !is_numeric($request->CALL[1]) || $request->CALL[0] < "0"|| $request->CALL[1] < "0"){
			return result(406, "Invalid parameter(s)");
		}
		
		$posID = $request->CALL[0];
		$storageID = $request->CALL[1];
		
		$res = $sudosos->query("SELECT ID FROM pointOfSales WHERE ID=?", array($posID));
	
			if($res->ERROR){
			return result(500, "Something went wrong");
			}	
			if($res->COUNT !== 1){
			return result(404, "Point of Sales not found");
			}
		
		$res2 = $sudosos->query("SELECT ID FROM storage WHERE ID=?", array($storageID));
			if($res2->ERROR){
			return result(500, "Something went wrong");
			}	
			if($res2->COUNT !== 1){
			return result(404, "Storage not found");
			}
			
		$res3 = $sudosos->query("SELECT * FROM storagePointOfSales WHERE pointOfSalesID=? AND storageID=?", array($posID,$storageID));
			if($res3->ERROR){
			return result(500, "Something went wrong");
			}	
			if($res3->COUNT > 0){
			return result(409, "Storage is already being sold from the Point of Sales");
			}
			
		$result = $sudosos->query("INSERT into storagePointOfSales(`pointOfSalesID`,`storageID`) values(?, ?)", array($posID, $storageID));
			if($result->ERROR){
			return result(500, "Something went wrong");
			}	
			
		return result(200,"Success");
	 }
	 
	 /**
     * @SWG\Delete(
     *     path="pointOfSales/{posID}/sells/{storageID}",
     *     summary="Stop selling a given storage from a given Point of Sales",
     *     tags={"POS"},
     *           @SWG\Parameter(
     *           name="posID",
     *           type="integer",
     *           in="path",
     *           required=true,
     *           description="The identifier of the Point of Sales",
     *         ),@SWG\Parameter(
     *           name="storageID",
     *           type="integer",
     *           in="path",
     *           required=true,
     *           description="The identifier of the storage",
     *         ),
     *        @SWG\Response(
     *        response = 406,
     *        description = "Invalid parameter(s)",
     *      ),@SWG\Response(
     *        response = 400,
     *        description = "Missing parameter(s)",
     *      ),@SWG\Response(
     *        response = 409,
     *        description = "Storage is not being sold from the Point of Sales",
     *      ),@SWG\Response(
     *         response = 200,
     *         description = "Success",
     *      ),
     *	)
     */
	 public static function sellsDELETE($request){
	 global $sudosos;
	 
	 if(!isset($request->CALL[0]) || !isset($request->CALL[1])){
			return result(400, "Missing parameter(s)");
		}
		
		if (!is_numeric($request->CALL[0]) || !is_numeric($request->CALL[1]) || $request->CALL[0] < "0"|| $request->CALL[1] < "0"){
			return result(406, "Invalid parameter(s)");
		}
		
		$posID = $request->CALL[0];
		$storageID = $request->CALL[1];
		
		$res = $sudosos->query("DELETE FROM storagePointOfSales WHERE pointOfSalesID=? AND storageID=?", array($posID, $storageID));
		if($res->ERROR){
			return result(500, "Something went wrong");
		}	
		if($res->COUNT !== 1){
			return result(409, "Storage is not being sold from the Point of Sales");
		}
		
	return result(200,"Success");
	 }
}
	
?>
