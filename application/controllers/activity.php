<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of activity
 *
 * @author TrungHieu
 */
class Activity_Controller extends Base_Controller
{

    public function __construct()
    {
	parent::__construct();
	Asset::add('activity_css', 'css/activity.css');
    }
    
    public function action_index()
    {
	$current_user = CALOS\Repositories\UserRepository::current_user();
	return $this->action_user($current_user->id);
    }

    public function action_user($user_id)
    {
	$data = array();
	$user = CALOS\Repositories\UserRepository::find_by_id($user_id);
	if ($user)
	{
	    $unit = Input::get('unit') ? Input::get('unit') : 0;
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
	    $avail_roles = array(
		CALOS\Entities\ActivityEntity::ROLE_ALL,
		CALOS\Entities\ActivityEntity::ROLE_CREATOR,
		CALOS\Entities\ActivityEntity::ROLE_ASSIGNEE,
	    );
	    $role = in_array(Input::get('role'), $avail_roles) ? Input::get('role') : CALOS\Entities\ActivityEntity::ROLE_ALL;
	    if (($k = array_search($role, $avail_roles)) !== FALSE)
		unset($avail_roles[$k]);
	    $querystrings = $_GET;
	    $paginator = NULL;
	    $data['user'] = $user;
	    $data['vacancies'] = CALOS\Repositories\VacancyRepository::from_user_with_unit($user_id);
	    $data['activities'] = \CALOS\Repositories\ActivityRepository::paginate_user_task($user_id, $paginator, array(
			'sort' => $sort,
			'order' => $order,
			'filter' => $filter,
			'role' => $role,
			'unit' => $unit,
	    ));
	    $data['querystrings'] = $querystrings;
	    $data['paginate_total'] = $paginator->total;
	    $data['paginate_link'] = $paginator->appends(array(
			'sort' => $sort,
			'order' => $order,
			'filter' => $filter,
			'role' => $role,
			'unit' => $unit,
		    ))->links();
	    $data['paginate_start'] = ($paginator->page - 1) * $paginator->per_page;
	    $data['sort'] = $sort;
	    $data['avail_sorts'] = $avail_sorts;
	    $data['order'] = $order;
	    $data['avail_orders'] = $avail_orders;
	    $data['filter'] = $filter;
	    $data['avail_filters'] = $avail_filters;
	    $data['role'] = $role;
	    $data['avail_roles'] = $avail_roles;
	    $data['unit'] = $unit;
	    SEO::set_title(__('activity.activities of %s', array('name' => $user->display_name)));
	    Asset::add('activity_css', 'css/activity.css');
	    return View::make('activity.user', $data);
	}
    }

    public function action_view($activity_id)
    {
	$data = array();
	$user = CALOS\Repositories\UserRepository::current_user();
	$activity = \CALOS\Repositories\ActivityRepository::get_by_id($activity_id);
	if (Input::get('update_progress'))
	{
	    if ($activity->assignee->id == $user->id && $activity->status() != CALOS\Entities\ActivityEntity::STATUS_COMPLETED)
	    {
		\CALOS\Repositories\ActivityRepository::update_progress($activity_id, Input::get('progress'));
	    }
	}

	if (Input::get('update_complete'))
	{
	    if ($activity->creator->id == $user->id && $activity->status() != CALOS\Entities\ActivityEntity::STATUS_COMPLETED)
	    {
		\CALOS\Repositories\ActivityRepository::mark_complete($activity_id, trim(Input::get('comment')));
	    }
	}
	$activity = \CALOS\Repositories\ActivityRepository::get_by_id($activity_id);
	if ($activity)
	{
	    $data['activity'] = $activity;
	    $data['user'] = $user;

	    SEO::set_title($activity->title);
	    return View::make('activity.view', $data);
	}
    }

}

?>
