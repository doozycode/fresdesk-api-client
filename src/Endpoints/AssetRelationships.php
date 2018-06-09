<?php

namespace Doozycode\Freshservice\Endpoints;

/**
 * This section lists all the APIs that can be used to perform operations related to Asset Relationships
 * such as Creating, Deleting and Viewing relationships for an asset.
 *
 * Class AssetRelationships
 * @package Doozycode\Freshservice\Endpoints
 */
class AssetRelationships extends Endpoint
{
    /**
     * This API lets you view the list of all the relationship types configured in your helpdesk.
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function types()
    {
        return $this->_client->request("get", "/cmdb/relationship_types/list.json");
    }

    /**
     * This API lets you create a new relationship to an asset, requestor, agent or department
     * @param integer|string $id ID of asset
     * @param array $properties
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function create($id, $properties)
    {
        $options['json'] = $properties;
        return $this->_client->request("post", "/cmdb/items/{$id}/associate.json", $options);
    }

    /**
     * This API lets you delete an existing relationship of an asset.
     * @param integer|string $id ID of asset
     * @param integer|string $relationship_id
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function delete($id, $relationship_id)
    {
        $options['json'] = array('relationship_id'=>$relationship_id);
        return $this->_client->request("delete", "/cmdb/items/{$id}/detach_relationship.json");
    }

    /**
     * This API lets you view all the relationships of an asset
     * @param integer|string $id ID of asset
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function view($id)
    {
        return $this->_client->request("get", "/cmdb/items/{$id}/relationships.json");
    }
}