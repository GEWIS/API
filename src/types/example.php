<?php

/**
 *  ________   __          __  __ _____  _      ______ 
 * |  ____\ \ / /    /\   |  \/  |  __ \| |    |  ____|
 * | |__   \ V /    /  \  | \  / | |__) | |    | |__   
 * |  __|   > <    / /\ \ | |\/| |  ___/| |    |  __|  
 * | |____ / . \  / ____ \| |  | | |    | |____| |____ 
 * |______/_/ \_\/_/    \_\_|  |_|_|    |______|______|
 * 
 * This is an example file, and contains calls that demonstrate how to create your own API calls.
 */

/** 
 * @SWG\Resource(
 *     basePath="https://api.gewis.nl/"
 * )
 * resourcePath is detected as "/operations" based on the class-name.
 */
class example {


    /**
     * @SWG\Api(
     *     path="example/call",
     *     @SWG\Operation(
     *         summary="Do an example GET request",
     *         method="GET",
     *         nickname="call",
     *         notes="Outputs the GET parameters",
     *         @SWG\Parameter(
     *             name="data",
     *             type="string",
     *             paramType="query",
     *             required=true,
     *             allowMultiple=true
     *         )
     *     )
     * )
     */
    public static function callGET($request){
	   return $request;
    }

    /**
     * @SWG\Api(
     *     path="example/call",
     *     @SWG\Operation(
     *         summary="Do an example POST request",
     *         method="POST",
     *         nickname="call",
     *         notes="Outputs the POST and GET parameters merged",
     *         @SWG\Parameter(
     *             name="data",
     *             type="string",
     *             paramType="form",
     *             required=true,
     *             allowMultiple=true
     *         )
     *     )
     * )
     */
    public static function callPOST($request){
	   return $request;
    }

    /**
     * @SWG\Api(
     *     path="example/call",
     *     @SWG\Operation(
     *         summary="Do an example PUT request",
     *         method="PUT",
     *         nickname="call",
     *         notes="Outputs the PUT and GET parameters merged",
     *         @SWG\Parameter(
     *             name="data",
     *             type="string",
     *             paramType="form",
     *             required=true,
     *             allowMultiple=true
     *         )
     *     )
     * )
     */
    public static function callPUT($request){
        return $request;
    }

    /**
     * @SWG\Api(
     *     path="example/call",
     *     @SWG\Operation(
     *         summary="Do an example DELETE request",
     *         method="DELETE",
     *         nickname="call",
     *         notes="Outputs the DELETE and GET parameters merged",
     *         @SWG\Parameter(
     *             name="data",
     *             type="string",
     *             paramType="form",
     *             required=true,
     *             allowMultiple=true
     *         )
     *     )
     * )
     */
    public static function callDELETE($request){
	   return $request;
    }
}

?>

