<?php

/**
 * @SWG\Resource(
 *     basePath="https://api.gewis.nl/",
 *     resourcePath="storage",
 * )
 */
 
/**
 * @SWG\Model(
 *      id="storage",
 *      @SWG\Property(
 *             name="id",
 *             type="string",
 *             required=true,
 *             description="The id of the storage."
 *         ),
 *      @SWG\Property(
 *             name="name",
 *             type="string",
 *             required=true,
 *             description="The name of the storage."
 *         ),
 *      @SWG\Property(
 *             name="sells",
 *             type="array",
 *             items="$ref:products",
 *             required=true,
 *             description="The name of the storage."
 *         ),
 *    )
 */
class storage {
    
}

?>