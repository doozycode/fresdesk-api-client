<?php

namespace Doozycode\Freshservice\Endpoints;

/**
 * This section lists all API that can be used to create, edit or otherwise manipulate releases.
 *
 * Class Releases
 * @package Doozycode\Freshservice\Endpoints
 */
class Releases extends Endpoint
{
    /**
     * @var string
     */
    private $_path = '/itil/releases';

    /**
     * This API helps you to create a new release in your service desk
     * @param array $properties
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function create($properties)
    {
        $options['json'] = ['itil_release'=>$properties];
        return $this->_client->request("post", $this->_path.".json", $options);
    }

    /**
     * This API helps you delete a release
     * @param integer|string $id
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function delete($id)
    {
        return $this->_client->request("delete", $this->_path."/{$id}.json");
    }

    /**
     * This API lets you make changes to the parameters of a releses from updating statuses to changing release priority
     * @param integer|string $id
     * @param array $properties
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function update($id, $properties)
    {
        $options['json'] = ['itil_release'=>$properties];
        return $this->_client->request("put", $this->_path."/{$id}.json", $options);
    }

    /**
     * This API lets you retrieve and view a specific release and all conversations related to it in your service desk
     * @param integer|string $id
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function get($id)
    {
        return $this->_client->request("get", $this->_path."/{$id}.json");
    }

    /**
     * This API helps you to view all the releases in your service desk.
     * @param string $filter [all,new_my_open,deleted]
     * @param array $parameters
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function view($filter='all', $parameters=[])
    {
        if (!isset($parameters['page']))
        {
            $parameters['page']=0;
        }
        $parameters['format'] = 'json';
        return $this->_client->request("get", $this->_path."/filter/{$filter}?".http_build_query($parameters));
    }

    /**
     * This API lets you view the fields in a release.
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function fields()
    {
        return $this->_client->request("get", "/itil/problem_fields.json");
    }

    /**
     * If you wish to add notes to a release
     * @param integer|string $id
     * @param array $properties
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function addNote($id, $properties)
    {
        $options['json'] = ['itil_note'=>$properties];
        return $this->_client->request("post", $this->_path."/{$id}/notes.json", $options);
    }

    /**
     * @param integer|string $id
     * @param array $properties
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function detachAssets($id, $properties)
    {
        $options['json'] = ['itil_release'=>$properties];
        return $this->_client->request("put", $this->_path."/{$id}/detach_ci.json", $options);
    }
}