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

    public static function from_user_with_unit($user_id)
    {
	$query = \DB::table('user_vacancy')
		->left_join('vacancies', 'user_vacancy.vacancy_id', '=', 'vacancies.id')
		->left_join('organizationunits', 'vacancies.organizationunit_id', '=', 'organizationunits.id')
		->where('user_vacancy.is_valid', '=', true)
		->where('user_vacancy.user_id', '=', $user_id)
		->order_by('organizationunits.id')
		->order_by('vacancies.order');
	$result =  $query->get(array(
		    'vacancies.id as vacancy_id',
		    'vacancies.name as vacancy_name',
		    'organizationunits.name as unit_name',
		    'organizationunits.id as unit_id',
		));
	
	$ouput = array();
	$current_unit_id = 0;
	foreach($result as $row)
	{
	    if ($row->unit_id != $current_unit_id)
	    {
		$item = new VacancyEntity;
		$item->id = $row->vacancy_id;
		$item->name = $row->vacancy_name;
		$unit = new \CALOS\Entities\OrganizationUnitEntity;
		$unit->id = $row->unit_id;
		$unit->name = $row->unit_name;
		$item->unit = $unit;
		$ouput[] = $item;
		
		$current_unit_id = $row->unit_id;
	    }
	}
	return $ouput;
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
