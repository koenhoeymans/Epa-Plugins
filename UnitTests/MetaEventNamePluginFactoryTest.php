<?php

require_once 'TestHelper.php';

class EpaPlugins_UnitTests_MetaEventNamePluginFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function createsPluginInstance()
    {
        $this->assertEquals(
            \EpaPlugins\MetaEventNamePluginFactory::create(),
            new \EpaPlugins\MetaEventNamePlugin()
        );
    }
}
