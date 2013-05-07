<?php

namespace CALOS\Repositories;

/**
 * Description of OptionRepository
 *
 * @author TrungHieu
 */
class OptionRepository
{

    /**
     * Get an option, return null if not found
     * 
     * @param string $key   option key
     * @return string|null
     */
    public static function get_option($key)
    {
	$option = \Option::where('key', '=', $key)->first();
	if ($option)
	    return $option->value;
	return null;
    }

    public static function update_option($key, $value)
    {
	$option = \Option::where('key', '=', $key)->first();
	if ($option)
	{
	    $option->value = $value;
	    return $option->save();
	} else
	{
	    return (\Option::create(array('key' => $key, 'value' => $value)) !== false);
	}
    }

}

?>
