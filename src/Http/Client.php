<?php

namespace Doozycode\Freshservice\Http;

use GuzzleHttp\Client as GuzzleClient;
use Psr\Http\Message\ResponseInterface;
use Doozycode\Freshservice\Exceptions\BadRequest;
use Doozycode\Freshservice\Exceptions\InvalidArgument;

/**
 * Class Client
 * @package Doozycode\Freshservice\Http
 */
class Client
{
    /** @var string */
    public $_token;

    /** @var string */
    public $_domain;

    /** @var \GuzzleHttp\Client */
    public $http;
    /**
     * Guzzle allows options into its request method. Prepare for some defaults
     * @var array
     */
    protected $requestOptions = [];

    /**
     * if set to false, no Response object is created, but the one from Guzzle is directly returned
     * comes in handy own error handling
     *
     * @var bool
     */
    protected $wrapResponse = true;

    /** @var string */
    private $user_agent = "Doozy_Freshservice_PHP/1.0.0-rc.1";

    /**
     *
     * @param  array $config Configuration array
     * @param  GuzzleClient $client The Http Client (Defaults to Guzzle)
     * @param array $requestOptions options to be passed to Guzzle upon each request
     * @param bool $wrapResponse wrap request response in own Response object
     * @throws \Doozycode\Freshservice\Exceptions\InvalidArgument
     */
    public function __construct($config=[], $client = null, $requestOptions = [], $wrapResponse = true)
    {
        //$this->$requestOptions = $requestOptions;
        //$this->wrapResponse = $wrapResponse;

        $this->_domain = isset($config["domain"]) ? $config["domain"] : getenv("FRESHSERVICE_DOMAIN");
        $this->_token = isset($config["token"]) ? $config["token"] : getenv("FRESHSERVICE_SECRET");

        if (empty($this->_token)) {
            throw new InvalidArgument("You must provide a Freshservice token.");
        }

        $this->http = $client ?: new GuzzleClient();
    }

    /**
     * Send the request...
     *
     * @param  string $method The HTTP request verb
     * @param  string $endpoint The Freshservice API endpoint
     * @param  array $options An array of options to send with the request
     * @param  string $query_string A query string to send with the request
     * @param  boolean $requires_auth Whether or not this Freshservice API endpoint requires authentication
     * @return \Doozycode\Freshservice\Http\Response|ResponseInterface
     * @throws \Doozycode\Freshservice\Exceptions\BadRequest
     */
    public function request($method, $endpoint, $options = [], $query_string = null, $requires_auth = true)
    {
        $url = $this->generateUrl($endpoint, $query_string, $requires_auth);

        //$options = array_merge($this->$requestOptions, $options);
        $options["headers"]["User-Agent"] = $this->user_agent;

        $options["headers"]["Authorization"] = "Basic " . base64_encode($this->_token.':no');

        try {

            /*if ($this->wrapResponse === false) {
                return $this->http->request($method, $url, $options);
            }*/
            return new Response($this->http->request($method, $url, $options));
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            throw new BadRequest(\GuzzleHttp\Psr7\str($e->getResponse()), $e->getCode(), $e);
        } catch (\Exception $e) {
            throw new BadRequest($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Generate the full endpoint url, including query string.
     *
     * @param  string  $endpoint      The Freshservice API endpoint.
     * @param  string  $query_string  The query string to send to the endpoint.
     * @param  boolean $requires_auth Whether or not this Freshservice API endpoint requires authentication
     * @return string
     */
    public function generateUrl($endpoint='', $query_string = null, $requires_auth = true)
    {
        $url = "https://{$this->_domain}.freshservice.com".$endpoint;
        return $url;
    }
}