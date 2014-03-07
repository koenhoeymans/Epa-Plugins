<?php

namespace EpaPlugins;

/**
 * Creates a `MetaEventNamePlugin`.
 */
class MetaEventNamePluginFactory
{
	/**
	 * Creates the plugin instance.
	 * 
	 * @return \Epa\Api\Plugin
	 */
	public static function create()
	{
		return new MetaEventNamePlugin();
	}
}