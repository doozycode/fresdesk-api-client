<?php

namespace Doozycode\Freshservice\Endpoints;

/**
 * This section lists all API that can be used to create, edit or delete Assets.
 *
 * Class Assets
 * @package Doozycode\Freshservice\Endpoints
 */
class Assets extends Endpoint
{
    /**
     * @var string
     */
    private $_path = '/cmdb/items';

    /**
     * This API helps you to create a new asset in your service desk
     * @param array $properties
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function create($properties)
    {
        $options['json'] = ['cmdb_config_item' => $properties];
        return $this->_client->request("post", $this->_path.".json",  $options);
    }

    /**
     * This API lets you modify asset details.
     * @param integer|string $id
     * @param array $properties
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function update($id, $properties)
    {
        $options['json'] = ['cmdb_config_item' => $properties];
        return $this->_client->request("put", $this->_path."/{$id}.json",  $options);
    }

    /**
     * This API lets you delete a asset.
     * @param integer|string $id
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function delete($id)
    {
        return $this->_client->request("delete", $this->_path."/{$id}.json");
    }

    /**
     * If you deleted or disabled some assets and regret doing so now, this API will help you restore them.
     * @param integer|string $id
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function restore($id)
    {
        return $this->_client->request("put", $this->_path."/{$id}.json");
    }

    /**
     * This API lets you search for assets based on the some attributes.
     * @param string $search
     * @param array $parameters
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function search($search="", $parameters=[])
    {
        if (!isset($parameters['page']))
        {
            $parameters['page'] = 1;
        }
        if ($search)
        {
            $parameters['q'] = rawurlencode($search);
        }
        return $this->_client->request("get", $this->_path."/list.json?".http_build_query($parameters));
    }

    /**
     * This API lets you view all the assets in your list
     * @param int $page
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function view($page=1)
    {
        return $this->_client->request("get", $this->_path.".json?page={$page}");
    }

    /**
     * This API lets you view a particular asset.
     * @param integer|string $id ID of an asset
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function get($id)
    {
        return $this->_client->request("get", $this->_path."/{$id}.json");
    }

    /**
     * This API helps you to fetch all the available config item types in your help desk
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function types()
    {
        return $this->_client->request("get", "/cmdb/ci_types.json");
    }

    /**
     * This API helps you to fetch all the config item type fields related to a particular config item type in your help desk
     * @param integer|string $id
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function getTypeFields($id)
    {
        return $this->_client->request("get", "/cmdb/ci_types/{$id}.json");
    }
}
