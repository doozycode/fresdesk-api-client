<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 27.04.18
 * Time: 16:45
 */

namespace Doozycode\Freshservice\Endpoints;

use Doozycode\Freshservice\Http\Client;

class Endpoint
{
    /**
     * @var \Doozycode\Freshservice\Http\Client
     */
    protected $_client;

    /**
     * Resource constructor.
     * @param \Doozycode\Freshservice\Http\Client $client
     */
    public function __construct(Client $client)
    {
        $this->_client = $client;
    }

    public function getClient()
    {
        return $this->_client;
    }
}