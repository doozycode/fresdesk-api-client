<?php

namespace Doozycode\Freshservice\Endpoints;

/**
 * This section lists all API that can be used to create, edit or delete departments
 *
 * Class Departments
 * @package Doozycode\Freshservice\Endpoints
 */
class Departments extends Endpoint
{
    /**
     * @var string
     */
    private $_path = '/itil/departments';

    /**
     * This API lets you modify department details.
     * @param integer|string $id
     * @param $properties
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function update($id, $properties)
    {
        $options['json'] = ['itil_department' => $properties];
        return $this->_client->request("put", $this->_path."/{$id}.json", $options);
    }

    /**
     * This API lets you view a particular department.
     * @param integer|string $id
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function get($id)
    {
        return $this->_client->request("get", $this->_path."/{$id}.json");
    }

    /**
     * This API lets you delete a department.
     * @param integer|string $id
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function delete($id)
    {
        return $this->_client->request("delete", $this->_path."/{$id}.json");
    }

    /**
     * This API helps you to create a new department in your service desk.
     * @param array $properties
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function create($properties)
    {
        $options['json'] = ['itil_department' => $properties];
        return $this->_client->request("post", $this->_path.".json", $options);
    }

    /**
     * This API lets you view all the departments in your list.
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function view()
    {
        return $this->_client->request("get", $this->_path.".json");
    }
}
