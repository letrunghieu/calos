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

    public static function get_leader_vacancy_of_unit($unit_id)
    {
	return static::convert_from_orm(\Vacancy::where('organizationunit_id', '=', $unit_id)
				->where('order', '=', 0)->first());
    }

    public static function get_all_vacancy_ids($unit_id)
    {
	$child_units = \OrganizationUnit::where('parent_id', '=', $unit_id)->get();
	$result = array_map(function($item)
		{
		    return $item->id;
		}, \DB::table('vacancies')->where('organizationunit_id', '=', $unit_id)
			->where('is_current_valid', '=', true)->get(array('id')));
	foreach ($child_units as $child)
	{
	    $result = array_merge($result, static::get_all_vacancy_ids($child->id));
	}
	return $result;
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
	    \UserVacancy::where('vacancy_id', '=', $vacancy_id)->delete();
	}
	$obj = \UserVacancy::where('user_id', '=', $member_id)
		->where('vacancy_id', '=', $vacancy_id)
		->first();
	if (!$obj)
	    \UserVacancy::create(array(
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
