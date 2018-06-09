<?php

namespace tests\Doozycode\Freshservice\Endpoints;

use PHPUnit\Framework\TestCase;
use Doozycode\Freshservice\Freshservice;

class AgentsTest extends TestCase
{
    protected $_freshservice;

    public function setUp()
    {
        $this->_freshservice = new Freshservice();
    }

    public function testCanViewAgent()
    {
        $res = $this->_freshservice->agents->get("10000019009");
        $data = $res->toArray();

        $this->assertArrayHasKey("agent", $data);
        $this->assertArrayHasKey("user", $data['agent']);
    }

    public function testCanViewOnlyActiveAgents()
    {
        $res = $this->_freshservice->agents->view("active");
        $data = $res->toArray();

        $this->assertTrue(count($data)>0);

        foreach ($data as $agentdata)
        {
            $this->assertArrayHasKey("agent", $agentdata);
            $this->assertArrayHasKey("user", $agentdata['agent']);

            $userdata = $agentdata['agent']['user'];

            $this->assertTrue($userdata['active']);
        }
    }

    public function testCanViewOccasionalAgents()
    {
        $res = $this->_freshservice->agents->view("occasional");
        $data = $res->toArray();

        $this->assertTrue(count($data)>0);

        foreach ($data as $agentdata)
        {
            $this->assertArrayHasKey("agent", $agentdata);
            $this->assertArrayHasKey("user", $agentdata['agent']);

            $userdata = $agentdata['agent']['user'];

            $this->assertTrue($userdata['active']);
        }
    }
}