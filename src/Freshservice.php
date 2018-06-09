<?php

namespace Doozycode\Freshservice;

use Doozycode\Freshservice\Exceptions\InvalidEndpointException;

class Freshservice
{

    /**
     * @var Http\Client
     */
    private $client;

    /**
     * A array containing the cached Endpoints
     *
     * @var array
     */
    private $cachedEndpoints = [];

    public function __construct()
    {
        $this->client = new Http\Client();
    }

    /**
     * Get an Freshservice API resource
     *
     * @access public
     * @param string    $resource_name
     * @return mixed
     * @throws Exceptions\InvalidEndpointException
     */
    public function __get($resource_name)
    {
        $resource_name = strtolower($resource_name);
        $class = "\\Doozycode\Freshservice\\Endpoints\\" . ucfirst($resource_name);
        // Check if an instance has already been initiated

        if (!isset($this->cachedEndpoints[$resource_name])) {
            // Check endpoint existence
            if (!class_exists($class)) {
                throw new InvalidEndpointException;
            }
            // Create a reflection of the called class and initialize it
            // with a reference to the request class
            $ref = new \ReflectionClass($class);
            $obj = $ref->newInstanceArgs([$this->client, $this]);
            $this->cachedEndpoints[$resource_name] = $obj;
        }
        return $this->cachedEndpoints[$resource_name];
    }


}