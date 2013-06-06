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

    public function action_unit_announcements($unit_id)
    {
	$data = array();
	$org_unit = \CALOS\Repositories\OrganizationUnitRepository::get_by_id($unit_id);
	if ($org_unit)
	{
	    $avail_orders = array('asc', 'desc');
	    $order = in_array(Input::get('order'), $avail_orders) ? Input::get('order') : 'asc';
	    if (($k = array_search($order, $avail_orders)) !== FALSE)
		unset($avail_orders[$k]);
	    $querystrings = $_GET;
	    $paginator = NULL;
	    $data['org_unit'] = $org_unit;
	    $data['announcements'] = \CALOS\Repositories\AnnouncementRepository::paginate_unit_announcement($org_unit->id, $paginator, array(
			'order' => $order,
	    ));
	    $data['querystrings'] = $querystrings;
	    $data['paginate_total'] = $paginator->total;
	    $data['paginate_link'] = $paginator->appends(array(
			'order' => $order,
		    ))->links();
	    $data['paginate_start'] = ($paginator->page - 1) * $paginator->per_page;
	    $data['order'] = $order;
	    $data['avail_orders'] = $avail_orders;
	    SEO::set_title(__('organization.announcement of %s', array('name' => $org_unit->name)));
	    return View::make('organization.unit_announcements', $data);
	}
    }

    public function action_user_vacancies($user_id)
    {
	$data = array();
	$user = CALOS\Repositories\UserRepository::find_by_id($user_id);
	if ($user)
	{
	    $vacancies = CALOS\Repositories\VacancyRepository::from_user_with_unit($user_id);

	    $data['user'] = $user;
	    $data['vacancies'] = $vacancies;
	    SEO::set_title(__('organization.vacancies of %', array('name' => $user->display_name)));

	    return View::make('organization.user_vacancies', $data);
	}
    }

    public function action_unit_activities($unit_id)
    {
	$data = array();
	$org_unit = \CALOS\Repositories\OrganizationUnitRepository::get_by_id($unit_id);
	if ($org_unit)
	{
	    $avail_sorts = array('created_at', 'assigning_time', 'progress', 'deadline');
	    $sort = in_array(Input::get('sort'), $avail_sorts) ? Input::get('sort') : 'created_at';
	    if (($k = array_search($sort, $avail_sorts)) !== FALSE)
		unset($avail_sorts[$k]);
	    $avail_orders = array('asc', 'desc');
	    $order = in_array(Input::get('order'), $avail_orders) ? Input::get('order') : 'asc';
	    if (($k = array_search($order, $avail_orders)) !== FALSE)
		unset($avail_orders[$k]);
	    $avail_filters = array(
		CALOS\Entities\ActivityEntity::STATUS_ALL,
		CALOS\Entities\ActivityEntity::STATUS_COMPLETED,
		CALOS\Entities\ActivityEntity::STATUS_100_PERCENT,
		CALOS\Entities\ActivityEntity::STATUS_OCCURING,
		CALOS\Entities\ActivityEntity::STATUS_DELAYED,
	    );
	    $filter = in_array(Input::get('filter'), $avail_filters) ? Input::get('filter') : CALOS\Entities\ActivityEntity::STATUS_ALL;
	    if (($k = array_search($filter, $avail_filters)) !== FALSE)
		unset($avail_filters[$k]);
	    $querystrings = $_GET;
	    $paginator = NULL;
	    $data['org_unit'] = $org_unit;
	    $data['activities'] = \CALOS\Repositories\ActivityRepository::paginate_org_unit_task($unit_id, $paginator, array(
			'sort' => $sort,
			'order' => $order,
			'filter' => $filter,
	    ));
	    $data['querystrings'] = $querystrings;
	    $data['paginate_total'] = $paginator->total;
	    $data['paginate_link'] = $paginator->appends(array(
			'sort' => $sort,
			'order' => $order,
			'filter' => $filter,
		    ))->links();
	    $data['paginate_start'] = ($paginator->page - 1) * $paginator->per_page;
	    $data['sort'] = $sort;
	    $data['avail_sorts'] = $avail_sorts;
	    $data['order'] = $order;
	    $data['avail_orders'] = $avail_orders;
	    $data['filter'] = $filter;
	    $data['avail_filters'] = $avail_filters;
	    SEO::set_title(__('organization.activities in %s', array('name' => $org_unit->name)));
	    Asset::add('activity_css', 'css/activity.css');
	    return View::make('organization.unit_activities', $data);
	}
    }

    public function action_view_unit($unit_id)
    {
	$data = array();
	$org_unit = \CALOS\Repositories\OrganizationUnitRepository::get_by_id($unit_id);
	if ($org_unit)
	{
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

    public function action_unit_members($unit_id)
    {
	$data = array();
	$org_unit = \CALOS\Repositories\OrganizationUnitRepository::get_by_id($unit_id);
	if ($org_unit)
	{
	    $allowed = array('display_name', 'email', 'first_name');
	    $sort = in_array(Input::get('sort'), $allowed) ? Input::get('sort') : 'first_name';
	    $order = Input::get('order') === 'desc' ? 'desc' : 'asc';
	    $querystrings = $_GET;
	    $paginator = NULL;
	    $vacancy_ids = \CALOS\Repositories\VacancyRepository::get_all_vacancy_ids($unit_id);
	    $data['org_unit'] = $org_unit;
	    $data['parent'] = \CALOS\Repositories\OrganizationUnitRepository::get_parent($unit_id);
//	    $data['members'] = CALOS\Repositories\UserRepository::paginate_from_vacancies($vacancy_ids, $paginator, $sort, $order);
	    $data['members'] = CALOS\Repositories\UserRepository::paginate_from_unit_members($unit_id, $paginator, $sort, $order);
	    $data['querystrings'] = $querystrings;
	    $data['paginate_total'] = $paginator->total;
	    $data['paginate_link'] = $paginator->appends(array(
			'sort' => $sort,
			'order' => $order,
		    ))->links();
	    $data['paginate_start'] = ($paginator->page - 1) * $paginator->per_page;
	    SEO::set_title($org_unit->name);
	    return View::make('organization.unit_members', $data);
	}
    }

    public function action_edit_unit($unit_id)
    {
	$data = array();
	if (Input::get('commit'))
	{
	    if (!\CALOS\Services\OrganizationUnitService::validate_org_unit(Input::get('name'), Input::get('desctiption')))
	    {
		$data['messages']['error'][] = __('organization.name must be longer than 4');
	    } else
	    {
		if (CALOS\Repositories\OrganizationUnitRepository::update($unit_id, Input::get('name'), Input::get('description'), Input::get('parent_id'), Input::get('leader_title')))
		{
		    $data['messages']['success'][] = __('organization.updated');
		}
	    }
	}
	$org_unit = \CALOS\Repositories\OrganizationUnitRepository::get_by_id($unit_id);
	if ($org_unit)
	{
	    $data['leader_vacancy'] = \CALOS\Repositories\VacancyRepository::get_leader_vacancy_of_unit($unit_id);
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
