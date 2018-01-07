<?php

namespace Tests;

class FedapayObjectTest extends BaseTestCase
{
    /**
     * Should set and get object attributes
     */
    public function testShouldSetObjectAttribute()
    {
        $object = new \Fedapay\FedapayObject;
        $object->id = 1;
        $object->name = 'name';

        $this->assertEquals($object->id, 1);
        $this->assertEquals($object['id'], 1);
        $this->assertEquals($object->name, 'name');
        $this->assertEquals($object['name'], 'name');

        $object = new \Fedapay\FedapayObject(2);
        $this->assertEquals($object->id, 2);

        $object = new \Fedapay\FedapayObject(['foo' => 'value']);
        $this->assertEquals($object->foo, 'value');
        $this->assertTrue(isset($object->foo));
        $this->assertTrue(isset($object['foo']));
        $this->assertFalse(isset($object['doe']));
        $this->assertFalse(isset($object->doe));
    }

    public function testShouldSerializeObject()
    {
        $object = new \Fedapay\FedapayObject(['foo' => 'value']);
        $json = json_encode($object);

        $this->assertEquals($json, '{"foo":"value"}');
    }

    public function testShouldRefreshObject()
    {
        $object = new \Fedapay\FedapayObject;
        $object->refreshFrom(['foo' => 'value'], null);

        $this->assertEquals($object->foo, 'value');
    }

    public function testShouldSerializeObjectParams()
    {
        $object = new \Fedapay\FedapayObject;
        $object->refreshFrom(['foo' => 'value', 'id' => 2], null);
        $params = $object->serializeParameters();

        $this->assertTrue(is_array($params));
        $this->assertEquals($params['foo'], 'value');
        $this->assertArrayNotHasKey('id', $params);
    }
}
