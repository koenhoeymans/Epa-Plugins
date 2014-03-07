These are plugins to use with [Epa](https://github.com/koenhoeymans/Epa).

Currently there is one plugin: `MetaEventNamePlugin`. This plugin can be used
to name events based on the `@event` tag on a plugin doccomment:

	/**
	 * @event MyCustomEventName
	 */
	public class MyPlugin implements \Epa\Api\Plugin
	{}

This allows plugins to register handlers for the event `MyCustomEventName` instead
of only the classname.

You can add the plugin using the Epa library as follows:

	$plugin = \EpaPlugins\MetaEventNamePluginFactory::create();
	$eventDispatcher = \Epa\EventDispatcherFactory::create();
	$eventDispatcher->addPlugin($plugin);