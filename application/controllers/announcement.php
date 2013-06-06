<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of announcement
 *
 * @author TrungHieu
 */
class Announcement_Controller extends Base_Controller
{

    public function __construct()
    {
	parent::__construct();
	Asset::add('activity_css', 'css/activity.css');
    }

    public function action_index()
    {
	$data = array();
	$user = CALOS\Repositories\UserRepository::current_user();
	if ($user)
	{
	    $unit = Input::get('unit') ? Input::get('unit') : 0;
	    $avail_orders = array('asc', 'desc');
	    $order = in_array(Input::get('order'), $avail_orders) ? Input::get('order') : 'asc';
	    if (($k = array_search($order, $avail_orders)) !== FALSE)
		unset($avail_orders[$k]);
	    $avail_filters = array(
		CALOS\Entities\AnnouncementEntity::STATUS_ALL,
		CALOS\Entities\AnnouncementEntity::STATUS_READ,
		CALOS\Entities\AnnouncementEntity::STATUS_UNREAD,
	    );
	    $filter = in_array(Input::get('filter'), $avail_filters) ? Input::get('filter') : CALOS\Entities\AnnouncementEntity::STATUS_ALL;
	    if (($k = array_search($filter, $avail_filters)) !== FALSE)
		unset($avail_filters[$k]);
	    $avail_roles = array(
		CALOS\Entities\AnnouncementEntity::ROLE_RECEIVER,
		CALOS\Entities\AnnouncementEntity::ROLE_SENDER,
	    );
	    $role = in_array(Input::get('role'), $avail_roles) ? Input::get('role') : CALOS\Entities\AnnouncementEntity::ROLE_RECEIVER;
	    if (($k = array_search($role, $avail_roles)) !== FALSE)
		unset($avail_roles[$k]);
	    $querystrings = $_GET;
	    $paginator = NULL;
	    $data['user'] = $user;
	    $data['vacancies'] = CALOS\Repositories\VacancyRepository::from_user_with_unit($user->id);
	    $data['announcements'] = \CALOS\Repositories\AnnouncementRepository::paginate_user_announcement($user->id, $paginator, array(
			'order' => $order,
			'filter' => $filter,
			'role' => $role,
			'unit' => $unit,
	    ));
	    $data['querystrings'] = $querystrings;
	    $data['paginate_total'] = $paginator->total;
	    $data['paginate_link'] = $paginator->appends(array(
			'order' => $order,
			'filter' => $filter,
			'role' => $role,
			'unit' => $unit,
		    ))->links();
	    $data['paginate_start'] = ($paginator->page - 1) * $paginator->per_page;
	    $data['order'] = $order;
	    $data['avail_orders'] = $avail_orders;
	    $data['filter'] = $filter;
	    $data['avail_filters'] = $avail_filters;
	    $data['role'] = $role;
	    $data['avail_roles'] = $avail_roles;
	    $data['unit'] = $unit;
	    SEO::set_title(__('activity.activities of %s', array('name' => $user->display_name)));
	    return View::make('announcement.index', $data);
	}
    }

    public function action_view($id)
    {
	$data = array();
	$user = CALOS\Repositories\UserRepository::current_user();

	$announcement = \CALOS\Repositories\AnnouncementRepository::get_by_id($id);
	if ($announcement && \CALOS\Repositories\AnnouncementRepository::user_can_read($user->id, $announcement->id))
	{
	    if (Input::get('commit'))
	    {
		\CALOS\Repositories\AnnouncementRepository::confirm_read($user->id, $id);
	    }
	    $data['announcement'] = $announcement;
	    $data['user'] = $user;
	    return View::make('announcement.view', $data);
	}
    }
    
    public function action_view_read($id)
    {
	$data = array();
	$user = CALOS\Repositories\UserRepository::current_user();

	$announcement = \CALOS\Repositories\AnnouncementRepository::get_by_id($id);
	if ($announcement && \CALOS\Repositories\AnnouncementRepository::user_can_read($user->id, $announcement->id))
	{
	    if (Input::get('commit'))
	    {
		\CALOS\Repositories\AnnouncementRepository::confirm_read($user->id, $id);
	    }
	    $data['announcement'] = $announcement;
	    $data['user'] = $user;
	    $paginator = NULL;
	    $data['users'] = CALOS\Repositories\UserRepository::who_read_announcement($id, $paginator);
	    $data['paginate_total'] = $paginator->total;
	    $data['paginate_link'] = $paginator->links();
	    return View::make('announcement.view_read', $data);
	}
    }
    public function action_view_unread($id)
    {
	$data = array();
	$user = CALOS\Repositories\UserRepository::current_user();

	$announcement = \CALOS\Repositories\AnnouncementRepository::get_by_id($id);
	if ($announcement && \CALOS\Repositories\AnnouncementRepository::user_can_read($user->id, $announcement->id))
	{
	    if (Input::get('commit'))
	    {
		\CALOS\Repositories\AnnouncementRepository::confirm_read($user->id, $id);
	    }
	    $data['announcement'] = $announcement;
	    $data['user'] = $user;
	    $paginator = NULL;
	    $data['users'] = CALOS\Repositories\UserRepository::who_read_announcement($id, $paginator, false);
	    $data['paginate_total'] = $paginator->total;
	    $data['paginate_link'] = $paginator->links();
	    return View::make('announcement.view_unread', $data);
	}
    }

}

?>
