<?php

error_reporting(-1);

require_once __DIR__
	. DIRECTORY_SEPARATOR . '..'
	. DIRECTORY_SEPARATOR . 'EpaPlugins'
	. DIRECTORY_SEPARATOR . 'Autoload.php';

function EpaPlugins_EndToEndTests_Autoload($className)
{
	$className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
	$className = str_replace(
		'EpaPlugins' . DIRECTORY_SEPARATOR,
		'Epa-Plugins' . DIRECTORY_SEPARATOR,
		$className
	);
	$classNameFile = __DIR__
		. DIRECTORY_SEPARATOR . '..'
		. DIRECTORY_SEPARATOR . '..'
		. DIRECTORY_SEPARATOR . $className
		. '.php';

	if (file_exists($classNameFile))
	{
		require_once $classNameFile;
	}
}

spl_autoload_register('EpaPlugins_EndToEndTests_Autoload');