<?php

namespace tests\Doozycode\Freshservice\Endpoints;

use PHPUnit\Framework\TestCase;
use Doozycode\Freshservice\Freshservice;

class AssetsTest extends TestCase
{

    protected $_freshservice;

    public function setUp()
    {
        $this->_freshservice = new Freshservice();
    }

    public function testCanCreateAsset()
    {
        $data = [
            'impact'=>'2',
            'ci_type_id'=>'10000373924',
            'name'=>'Initial test device'
        ];

        $result = $this->_freshservice->assets->create($data);

        $response = $result->toArray();

        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);

        $this->assertArrayHasKey('item', $response);
        $this->assertArrayHasKey('config_item', $response['item']);

        $this->assertArrayHasKey('id', $response['item']['config_item']);

        return $response['item']['config_item'];

    }

    /**
     * @depends testCanCreateAsset
     * @param array $asset
     */
    public function testCanUpdateAsset($asset)
    {
        $data = [
            'impact'=>'3',
            'ci_type_id'=>'10000373924',
            'name'=>'Test device changed'
        ];

        $result = $this->_freshservice->assets->update($asset['display_id'], $data);

        $response = $result->toArray();

        $this->assertArrayHasKey('status', $response);
        $this->assertTrue($response['status']);

        $this->assertArrayHasKey('item', $response);
        $this->assertArrayHasKey('config_item', $response['item']);

        $this->assertArrayHasKey('id', $response['item']['config_item']);

        return $response['item']['config_item'];
    }

    /**
     * @depends testCanUpdateAsset
     * @param array $asset
     */
    public function testCanViewParticularAsset($asset)
    {
        $result = $this->_freshservice->assets->get($asset['display_id']);

        $response = $result->toArray();

        $this->assertArrayHasKey('config_item', $response);
        $this->assertArrayHasKey('id', $response['config_item']);
        $this->assertTrue($response['config_item']['id'] == $asset['id']);

        return $response['config_item'];
    }

    /**
     * @depends testCanViewParticularAsset
     * @param array $asset
     */
    public function testCanSearchForAsset($asset)
    {
        /**
         * ‘name’
         * ‘asset_tag’
         * ‘serial_number’
         */

        $parameters['field'] = 'name';
        $result = $this->_freshservice->assets->search($asset['name'], $parameters);

        $response = $result->toArray();

        var_dump($response); die();
    }

    /**
     * @depends testCanViewParticularAsset
     * @param $asset
     */
    public function testCanDeleteAsset($asset)
    {
        $result = $this->_freshservice->assets->delete($asset['display_id']);

        $response = $result->toArray();

        $this->assertArrayHasKey('success', $response);
        $this->assertTrue($response['success']);
    }

    public function testCanViewAssets()
    {
        $result = $this->_freshservice->assets->view();

        $response = $result->toArray();

        $this->assertTrue(count($response)>0);
        $this->assertTrue(count(array_column($response, 'id'))>0);
    }




    /*
    public function testCanGetAssetTypes()
    {

    }

    public function testCanGetAssetTypeFields()
    {

    }
    */

}