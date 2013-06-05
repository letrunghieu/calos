<?php namespace CALOS\Services;

/**
 * Description of OrganizationUnitService
 *
 * @author TrungHieu
 */
class OrganizationUnitService
{
    public static function validate_org_unit($name, $description)
    {
	return strlen($name) > 4;
    }
}

?>
