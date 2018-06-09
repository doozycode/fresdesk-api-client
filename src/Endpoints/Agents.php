<?php

namespace Doozycode\Freshservice\Endpoints;

/**
 * You can view agents information using the following APIs.
 * Only users with admin privileges can access the following APIs.
 *
 * Class Agents
 * @package Doozycode\Freshservice\Endpoints
 */
class Agents extends Endpoint
{
    /**
     * If you want to view a particular agent, this API can be used.
     * @param integer|string $id
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function get($id)
    {
        return $this->_client->request('get', "/agents/{$id}.json");
    }

    /**
     * If you want to view a list of agents, this API can be used.
     * @param string $state /agents/filter/[state]?format=json i.e., [active/occasional]
     * @param array $filters
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function view($state='active', $filters=array())
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
        return $this->_client->request('get', "/agents/filter/{$state}?format=json&query={$query}");
    }
}
