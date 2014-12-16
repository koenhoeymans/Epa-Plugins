<?php

namespace EpaPlugins;

class MetaEventNamePluginUseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function usesEventNameInPhpDoc()
    {
        $eventDispatcher = \Epa\EventDispatcherFactory::create();

        $eventDispatcher->addPlugin(new \EpaPlugins\MetaEventNamePlugin());

        $plugin = new \EpaPlugins\Plugin();
        $eventDispatcher->addPlugin($plugin);

        $eventDispatcher->notify(new \EpaPlugins\Event());

        $this->assertTrue($plugin->wasNotifiedOfMyEventName());
    }
}
