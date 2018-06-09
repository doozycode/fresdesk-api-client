<?php

namespace Doozycode\Freshservice\Endpoints;

/**
 * The Solution APIs allow you to perform all activities related to the creation and publishing of solutions to your requesters.
 * You can create, modify or delete solutions from anywhere you want using the Solutions API.
 *
 * Class SolutionCategories
 * @package Doozycode\Freshservice\Endpoints
 */
class SolutionCategories extends Endpoint
{
    /**
     * @var string
     */
    private $_path = '/solution/categories';

    /**
     * Use this API to create a new category of solutions
     * @param array $properties
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function create($properties)
    {
        $options['json'] = ['solution_category'=>$properties];
        return $this->_client->request("post", $this->_path.".json", $options);
    }

    /**
     * To delete certain Categories, use this API.
     * @param integer|string $id
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function delete($id)
    {
        return $this->_client->request("delete", $this->_path."/{$id}.json");
    }

    /**
     * Use this API to update solution categories
     * @param integer|string $id
     * @param array $properties
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function update($id, $properties)
    {
        $options['json'] = ['solution_category'=>$properties];
        return $this->_client->request("put", $this->_path."/{$id}.json", $options);
    }

    /**
     * To view the category available in your service desk, use this
     * @param integer|string $id
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function get($id)
    {
        return $this->_client->request("get", $this->_path."/{$id}.json");
    }

    /**
     * This API lets you view all the categories in a forum.
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function view()
    {
        return $this->_client->request("get", $this->_path.".json");
    }
}
