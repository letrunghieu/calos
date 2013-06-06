<?php

namespace CALOS\Services;

/**
 * Description of ConvertService
 *
 * @author TrungHieu
 */
class ConvertService
{

    public static function to_entity($input, $convert_function)
    {
	if ($input == NULL)
	    return NULL;
	$is_array = is_array($input);
	if (!$is_array)
	    $input = array($input);
	$result = array();
	foreach ($input as $row)
	{
	    $item = call_user_func($convert_function, $row);
	    $result[] = $item;
	}
	if (!$is_array)
	    $result = $result[0];
	return $result;
    }

}

?>
