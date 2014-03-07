<?php

require_once('TestHelper.php');

class EpaPlugins_EndToEndTests_MetaEventNamePluginTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @test
	 */
	public function usesEventNameInPhpDoc()
	{
		$eventDispatcher = \Epa\EventDispatcherFactory::create();

		$eventDispatcher->addPlugin(new \EpaPlugins\MetaEventNamePlugin());

		$plugin = new \EpaPlugins\EndToEndTests\Support\Plugin();
		$eventDispatcher->addPlugin($plugin);

		$eventDispatcher->notify(new \EpaPlugins\EndToEndTests\Support\Event());

		$this->assertTrue($plugin->wasNotifiedOfMyEventName());
	}
}