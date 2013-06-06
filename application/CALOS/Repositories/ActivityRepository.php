<?php

namespace CALOS\Repositories;

use CALOS\Entities\ActivityEntity;

/**
 * Description of ActivityRepository
 *
 * @author TrungHieu
 */
class ActivityRepository
{

    public static function paginate_date_task($user_id, $date, &$paginator, $options = array())
    {
	$default = array(
	    'sort' => 'assigning_time',
	    'order' => 'asc',
	    'per_page' => \Config::get('item_per_page', 20),
	);

	$options = array_merge($default, $options);
	$today = new \DateTime();

	$paginator = \Activity::where('creator_id', '=', $user_id)
		->where('deadline', '<=', $today)
		->order_by($options['sort'], $options['order'])
		->paginate($options['per_page']);
	return static::convert_from_orm($paginator->results);
    }

    public static function paginate_org_unit_task($unit_id, &$paginator, $options = array())
    {
	$default = array(
	    'sort' => 'created_at',
	    'order' => 'asc',
	    'filter' => ActivityEntity::STATUS_ALL,
	    'per_page' => \Config::get('item_per_page', 20),
	);

	$options = array_merge($default, $options);
	$today = new \DateTime();
	$query = \Activity::where('organizationunit_id', '=', $unit_id);
	switch ($options['filter'])
	{
	    case ActivityEntity::STATUS_COMPLETED:
		$query->where_not_null('completed_time');
		break;
	    case ActivityEntity::STATUS_100_PERCENT:
		$query->where_null('completed_time')
			->where('progress', '=', 100);
		break;
	    case ActivityEntity::STATUS_OCCURING:
		$query->where_null('completed_time')
			->where('deadline', '>', $today)
			->where('progress', '<', 100);
		break;
	    case ActivityEntity::STATUS_DELAYED:
		$query->where_null('completed_time')
			->where('deadline', '<=', $today)
			->where('progress', '<', 100);
		break;
	}

	$paginator = $query->order_by($options['sort'], $options['order'])
		->paginate($options['per_page']);
	return (array)static::convert_from_orm($paginator->results);
    }

    public static function create($title, $description, $user_id, $unit_id, $deadline, $parent_id = NULL)
    {
	$create = \Activity::create(array(
		    'title' => $title,
		    'description' => $description,
		    'creator_id' => $user_id,
		    'organizationunit_id' => $unit_id,
		    'deadline' => $deadline,
		    'parent_id' => $parent_id,
	));
	return $create;
    }

    public static function assign_to($assignee_id, $activity_id)
    {
	$activity = \Activity::find($activity_id);
	if ($activity)
	{
	    $activity->assignee_id = $assignee_id;
	    $activity->assigning_time = (new \DateTime);
	    $activity->save();
	}
    }

    public static function update_progress($activity_id, $progress_percent)
    {
	$activity = \Activity::find($activity_id);
	if ($activity)
	{
	    $activity->progress = $progress_percent;
	    $activity->save();
	}
    }

    public static function mark_complete($activity_id, $comment = "")
    {
	$activity = \Activity::find($activity_id);
	if ($activity)
	{
	    $activity->creator_comment = $comment;
	    $activity->completed_time = (new \DateTime);
	    $activity->save();
	}
    }

    /**
     * 
     * @param type $input
     * @return ActivityEntity
     */
    public static function convert_from_orm($input)
    {
	return \CALOS\Services\ConvertService::to_entity($input, function($obj)
			{
			    $entity = new ActivityEntity;
			    $entity->id = $obj->id;
			    $entity->title = $obj->title;
			    $entity->description = $obj->description;
			    $entity->progress = $obj->progress;
			    $entity->is_valid = $obj->is_valid;
			    $entity->creator = UserRepository::convert_from_orm($obj->creator);
			    $entity->assignee = UserRepository::convert_from_orm($obj->assignee);
			    $entity->org_unit = OrganizationUnitRepository::convert_from_orm($obj->org_unit);
			    $parent = $obj->parent_activity;
			    if ($parent)
			    {
				$entity->parent = new ActivityEntity;
				$entity->parent->id = $parent->id;
				$entity->parent->title = $parent->title;
			    }
			    $entity->created_at = new \DateTime($obj->created_at);
			    $entity->deadline = new \DateTime($obj->deadline);
			    $entity->assigning_time = $obj->assigning_time ? new \DateTime($obj->assigning_time) : null;
			    $entity->completed_time = $obj->completed_time ? new \DateTime($obj->completed_time) : null;
			    $entity->creator_comment = $obj->creator_comment;

			    return $entity;
			});
    }

}

?>
