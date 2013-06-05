<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Organization_Controller extends Base_Controller
{

    public function __construct()
    {
	parent::__construct();
	Asset::add('organization_css', 'css/organization.css');
    }

    public function action_index()
    {
	$org_unit = \CALOS\Repositories\OrganizationUnitRepository::get_organizaion();
	$data = array();
	$data['org_unit'] = $org_unit;
	$data['vacancies'] = \CALOS\Repositories\VacancyRepository::from_unit($org_unit->id);
	$data['children'] = \CALOS\Repositories\OrganizationUnitRepository::get_children($org_unit->id);
	SEO::set_title('View our organization structure');
	return View::make('organization.index', $data);
    }

    public function action_view_unit($unit_id)
    {
	$org_unit = \CALOS\Repositories\OrganizationUnitRepository::get_by_id($unit_id);
	if ($org_unit)
	{

	    $data = array();
	    $data['org_unit'] = $org_unit;
	    $data['vacancies'] = \CALOS\Repositories\VacancyRepository::from_unit($org_unit->id);
	    $data['children'] = \CALOS\Repositories\OrganizationUnitRepository::get_children($org_unit->id);
	    $data['parent'] = \CALOS\Repositories\OrganizationUnitRepository::get_parent($unit_id);
	    SEO::set_title($org_unit->name);
	    if ($data['parent'])
	    {
		return View::make('organization.view_unit', $data);
	    } else
	    {
		return View::make('organization.index', $data);
	    }
	}
    }

    public function action_view_unit_vacancy($unit_id)
    {
	$data = array();
	return View::make('organization.view_unit_vacancy', $data);
    }

    public function action_edit_unit($unit_id)
    {
	$org_unit = \CALOS\Repositories\OrganizationUnitRepository::get_by_id($unit_id);
	if ($org_unit)
	{

	    $data = array();
	    $data['org_unit'] = $org_unit;
	    $data['parent'] = \CALOS\Repositories\OrganizationUnitRepository::get_parent($unit_id);
	    $data['units'] = \CALOS\Repositories\OrganizationUnitRepository::get_all_hierachy();
	    SEO::set_title($org_unit->name);
	    return View::make('organization.edit_unit', $data);
	}
    }

    public function action_edit_unit_vacancy($unit_id)
    {
	$data = array();
	return View::make('organization.edit_unit_vacancy', $data);
    }

    public function action_edit_unit_member($unit_id)
    {
	$data = array();
	return View::make('organization.edit_unit_member', $data);
    }

}
