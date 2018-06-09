<?php

namespace Doozycode\Freshservice\Endpoints;

/**
 * You can create users, view and update user information using the following APIs
 *
 * Class Users
 * @package Doozycode\Freshservice\Endpoints
 */
class Users extends Endpoint
{
    /**
     * This API helps you create new users
     * @param array $properties
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function create($properties)
    {
        $options['json'] = ['user' => $properties];
        return $this->_client->request("post", "/itil/requesters.json",  $options);
    }

    /**
     * This API helps you modify the details of an existing use
     * @param integer|string $id
     * @param array $properties
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function update($id, $properties)
    {
        $options['json'] = ['user' => $properties];
        return $this->_client->request("put", "/itil/requesters/{$id}.json", $options);
    }

    /**
     * This API lets you delete a user.
     * @param integer|string $id
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function delete($id)
    {
        return $this->_client->request("delete", "/itil/requesters/{$id}.json");
    }

    /**
     * If you want to view/spy/stalk a particular user, this API can be used.
     * @param integer|string $id
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function get($id)
    {
        return $this->_client->request("get", "/itil/requesters/{$id}.json");
    }

    /**
     * If you want to view a list of users, this API can be used.
     * @param integer $page
     * @param string $state i.e., [verified/unverified/all/deleted]
     * @param array $filters
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function view($page=1, $state="all", $filters=array())
    {
        $filters = array_filter($filters, function($name)
        {
            return in_array($name, ['email','mobile','phone']);
        }, ARRAY_FILTER_USE_KEY);

        $query =  '';
        if ($filters)
        {
            foreach ($filters as $name=>$value)
            {
                $query .= "{$name} is {$value} ";
            }
            $query = rawurldecode($query);
        }
        return $this->_client->request("get", "/itil/requesters.json?page={$page}&state={$state}&query={$query}");
    }
}
