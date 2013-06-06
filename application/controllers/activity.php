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
