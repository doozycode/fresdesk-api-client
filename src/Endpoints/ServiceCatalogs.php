<?php

namespace Doozycode\Freshservice\Endpoints;

/**
 * This section lists all APIs that can be used to create or manipulate Service Requests.
 *
 * Class ServiceCatalogs
 * @package Doozycode\Freshservice\Endpoints
 */
class ServiceCatalogs extends Endpoint
{
    /**
     * This API helps you create a service request with agent as requester
     * @param integer|string $user_id
     * @param array $properties
     */
    public function create($user_id, $properties)
    {
        $options['json'] = $properties;
        $this->_client->request("post", "/catalog/request_items/{$user_id}/service_request.json.json", $options);
    }

    /**
     * This API helps you to view all the service items in your service desk.
     * @param int $page
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function view($page=1)
    {
        return $this->_client->request("get", "/catalog/items.json?page={$page}");
    }

    /**
     * This API helps you to view all the service items in a particular category in your service desk.
     * @param integer|string $category_id
     * @param int $page
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function viewByCategory($category_id, $page=1)
    {
        return $this->_client->request("get", "/catalog/categories/{$category_id}/items.json?page={$page}");
    }

    /**
     * This API helps you to view all the service categories in your service desk.
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function categories()
    {
        return $this->_client->request("get", "/catalog/categories.json");
    }

    /**
     * This API helps you to view the details of a service item in your service desk.
     * @param integer|string $category_id
     * @param int $page
     * @return \Doozycode\Freshservice\Http\Response|\Psr\Http\Message\ResponseInterface
     */
    public function details($category_id, $page=1)
    {
        $url = "/catalog/items/{$category_id}.json?page={$page}";
        return $this->_client->request("get", $url);
    }
}