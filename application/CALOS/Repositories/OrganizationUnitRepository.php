<?php

namespace CALOS\Repositories;

use CALOS\Entities\OrganizationUnitEntity;

/**
 * Description of OrganizationUnitRepository
 *
 * @author TrungHieu
 */
class OrganizationUnitRepository
{

    public static function get_by_id($id)
    {
	return static::convert_from_orm(\OrganizationUnit::find($id));
    }

    public static function get_all_hierachy($root = 1)
    {
	$unit = \OrganizationUnit::find($root);
	$children = (array) $unit->child_units;
	$child_units = array();
	foreach ($children as $u)
	{
	    $child_units[] = static::get_all_hierachy($u->id);
	}
	return array(
	    'item' => static::convert_from_orm($unit),
	    'children' => $child_units
	);
    }

    public static function get_organizaion()
    {
	return static::convert_from_orm(\OrganizationUnit::where_null('parent_id')->first());
    }

    public static function add_member($unit_id, $user_id)
    {
	$vacancy = \Vacancy::where('organizationunit_id', '=', $unit_id)
			->where('order', '=', 1000)->first();
	VacancyRepository::assign_member($vacancy->id, $user_id);
    }

    public static function assign_leader($unit_id, $user_id)
    {
	static::add_member($unit_id, $user_id);
	$vacancy = \Vacancy::where('organizationunit_id', '=', $unit_id)
			->where('order', '=', 0)->first();

	VacancyRepository::assign_member($vacancy->id, $user_id, true);
    }

    public static function get_children($unit_id)
    {
	return array_map(function($unit)
		{
		    return static::convert_from_orm($unit);
		}, \OrganizationUnit::where('parent_id', '=', $unit_id)
			->where('is_valid', '=', true)->get());
    }

    public static function get_parent($unit_id)
    {
	$unit = \OrganizationUnit::find($unit_id);
	if ($unit)
	    return static::convert_from_orm($unit->parent_unit);
    }

    /**
     * 
     * @param type $name
     * @param type $desciption
     * @param type $parent_id
     * @param type $leader_title
     * @param type $leader_descr
     * @return OrganizationUnitEntity;
     */
    public static function create($name, $desciption, $parent_id, $leader_title = "", $leader_descr = "")
    {
	if (!$leader_title)
	    $leader_title = __('organization.leader title');
	$depth = 0;
	if ($parent_id)
	{
	    $parent = \OrganizationUnit::find($parent_id);
	    $depth = $parent->depth + 1;
	}
	$unit = \OrganizationUnit::create(array(
		    'name' => $name,
		    'description' => $desciption,
		    'parent_id' => $parent_id,
		    'depth' => $depth,
	));

	if ($unit)
	{
	    $vacancy = VacancyRepository::create($leader_title, $leader_descr, $unit->id, 0);
	    $vacancy = VacancyRepository::create(__('organization.member title'), "", $unit->id, 1000);
	}
	return $unit;
    }

    public static function update($id, $name, $descriptiion, $parent_id = NULL, $leader_title = NULL)
    {
	$unit = \OrganizationUnit::find($id);
	if ($unit)
	{
	    $unit->name = $name;
	    $unit->description = $descriptiion;
	    if ($parent_id)
		$unit->parent_id = $parent_id;
	    if ($leader_title)
	    {
		\DB::table('vacancies')
			->where('organizationunit_id', '=', $id)
			->update(array('name' => $leader_title));
	    }
	    return $unit->save();
	}
	return false;
    }

    public static function convert_from_orm($obj)
    {
	if (!$obj)
	    return NULL;
	$entity = new OrganizationUnitEntity;
	$entity->id = $obj->id;
	$entity->name = $obj->name;
	$entity->description = $obj->description;
	$entity->parent_id = $obj->parent_id;
	$entity->created_at = $obj->created_at;
//	$entity->leader_vacancy = VacancyRepository::convert_from_orm($obj->leader_vacancy);

	return $entity;
    }

}

?>
