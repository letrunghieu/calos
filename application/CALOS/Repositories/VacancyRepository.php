<?php

namespace CALOS\Repositories;

use CALOS\Entities\VacancyEntity;

/**
 * Description of VacancyRepository
 *
 * @author TrungHieu
 */
class VacancyRepository
{

    public static function from_unit($unit_id, $with_members = true)
    {
	return array_map(function($item) use ($with_members)
		{
		    return static::convert_from_orm($item, $with_members);
		}, \Vacancy::where('organizationunit_id', '=', $unit_id)
			->order_by('order')
			->get());
    }

    public static function create($name, $description, $unit_id, $order)
    {
	$vacancy = \Vacancy::create(array(
		    'name' => $name,
		    'description' => $description,
		    'organizationunit_id' => $unit_id,
		    'order' => $order,
	));
	return static::convert_from_orm($vacancy);
    }

    public static function assign_member($vacancy_id, $member_id, $replace_old = false)
    {
	if ($replace_old)
	{
	    \DB::table('user_vacancy')
		    ->where('vacancy_id', '=', $vacancy_id)
		    ->delete();
	}
	\DB::table('user_vacancy')
		->insert(array(
		    'user_id' => $member_id,
		    'vacancy_id' => $vacancy_id,
	));
    }

    public static function convert_from_orm($obj, $with_members = false)
    {
	if (!$obj)
	    return NULL;
	$entity = new VacancyEntity;
	$entity->id = $obj->id;
	$entity->name = $obj->name;
	$entity->description = $obj->description;
	$entity->order = $obj->order;
	$entity->org_unit_id = $obj->organizationunit_id;
	$entity->is_valid = $obj->is_current_valid;
	if ($with_members)
	    $entity->members = array_map(function($user)
		    {
			return UserRepository::convert_from_orm($user);
		    }, (array) $obj->members);

	return $entity;
    }

}

?>
