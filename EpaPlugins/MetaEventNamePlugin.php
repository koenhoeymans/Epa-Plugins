<?php

namespace EpaPlugins;

/**
 * Adds event names in the doc comments as an event name that can be registered for.
 * For example the following in the doc comments above an event:
 * 
 *     @eventname Foo
 * 
 * This adds the event name 'Foo' for an event class when you use this plugin.
 */
class MetaEventNamePlugin implements \Epa\Api\Plugin
{
	/**
	 * @see \Epa\Api\Plugin::registerHandlers()
	 */
	public function registerHandlers(\Epa\Api\EventDispatcher $dispatcher)
	{
		$dispatcher->registerForEvent(
			'Epa\\Api\\NewEventEvent',
			function(\Epa\Api\NewEventEvent $event) { $this->handleEvent($event); }
		);
	}

	public function handleEvent(\Epa\Api\NewEventEvent $event)
	{
		foreach ($event->getEventNames() as $eventName)
		{
			if (!(class_exists($eventName) || interface_exists($eventName)))
			{
				continue;
			}

			$this->addDocCommentNames($eventName, $event);
			foreach (class_implements($event) as $implemented)
			{
				$this->addDocCommentNames($implemented, $event);
			}
			foreach (class_parents($eventName) as $extended)
			{
				$this->addDocCommentNames($extended, $event);
			}
		}
	}

	private function addDocCommentNames($class, \Epa\Api\NewEventEvent $event)
	{
		$reflClass = new \ReflectionClass($class);
		$docComm = $reflClass->getDocComment();

		preg_match_all(
			"@(?<=\n)\s*\*\s\@event\s+(?<name>\S+?)(?=\n)@i",
			$docComm,
			$matches,
			PREG_PATTERN_ORDER
		);
		if (isset($matches['name']))
		{
			foreach ($matches['name'] as $name)
			{
				$event->addName($name);
			}
		}
	}
}