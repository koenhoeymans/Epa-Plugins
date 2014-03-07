<?php

namespace EpaPlugins\EndToEndTests\Support;

class Plugin implements \Epa\Api\Plugin
{
	private $wasNotifiedOfMyEventName = false;

	public function registerHandlers(\Epa\Api\EventDispatcher $dispatcher)
	{
		$dispatcher->registerForEvent(
			'MyEventName', function() { $this->wasNotifiedOfMyEventName = true; }
		);
	}

	public function wasNotifiedOfMyEventName()
	{
		return $this->wasNotifiedOfMyEventName;
	}
}