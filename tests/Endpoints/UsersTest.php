<?php

namespace tests\Doozycode\Freshservice\Endpoints;

use PHPUnit\Framework\TestCase;
use Doozycode\Freshservice\Freshservice;

class UsersTest extends TestCase
{
    private $_freshservice;

    public function setUp()
    {
        $this->_freshservice = new Freshservice();
    }

    public function testCanCreateRequester()
    {
        $properties['name'] = 'TEST Company name';
        $properties['email'] = 'fcv2@dkd.com';
        $properties['address'] = 'fake address';
        $properties['phone'] = '+38(050)422-61-43';
        $properties['time_zone'] = 'Amsterdam';

        $response = $this->_freshservice->users->create($properties);

        $data = $response->getData();

        $this->assertTrue(is_object($data));
        $this->assertTrue(property_exists($data, 'user'));

        return $data->user;
    }

    /**
     * @depends testCanCreateRequester
     */
    public function testCanEditRequester($user)
    {

        $properties['time_zone'] = 'Berlin';
        $response = $this->_freshservice->users->update($user->id, $properties);

        $this->assertEquals($response->getData(), NULL);

        return $user;
    }

    /**
     * @depends testCanEditRequester
     */
    public function testCanDeleteRequester($user)
    {
        $response = $this->_freshservice->users->delete($user->id);
        $data = $response->getData();

        $this->assertEquals($data, 'deleted');
    }

    public function testCanViewListOfRequesters()
    {
        $response = $this->_freshservice->users->view('all');
        $data = $response->getData();

        var_dump($data);die();
    }
}