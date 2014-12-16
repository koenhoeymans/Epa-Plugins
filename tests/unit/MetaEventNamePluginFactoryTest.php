<?php

namespace EpaPlugins;

class MetaEventNamePluginFactoryTest extends \PHPUnit_Framework_TestCase
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
