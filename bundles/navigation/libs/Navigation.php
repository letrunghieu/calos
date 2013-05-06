<?php

namespace Navigation;

use Navigation\NavigationContainer;

/**
 * Description of Navigation
 *
 * @author TrungHieu
 */
class Navigation
{

    /**
     * The array of current registered navigations
     *
     * @var mixed 
     */
    private static $_navigations;

    /**
     * Create new navigation and register it if you want
     * 
     * @param string $name  the name of the container
     * @param mixed $options	the rendering options for this containers
     * @return \Navigation\NavigationContainer
     */
    public static function make($name, $options = array(), $register = true)
    {
	$container = new NavigationContainer($name, $options);
	if ($register)
	    static::$_navigations[$name] = $container;
	return $container;
    }

    /**
     * Get a navigation container if it is registered
     * 
     * @param string $name
     * @return \Navigation\NavigationContainer|null
     */
    public static function get($name)
    {
	if (key_exists($name, static::$_navigations))
	    return static::$_navigations[$name];
	else
	    return null;
    }

    /**
     * Determine whether a navigation is registered with a particular name
     * 
     * @param string $name
     * @return boolean
     */
    public static function is_registered($name)
    {
	return key_exists($name, static::$_navigations);
    }

}

?>
