<?php

namespace CALOS\Entities;

/**
 * Description of ActivityEntity
 *
 * @author TrungHieu
 */
class ActivityEntity
{

    const STATUS_COMPLETED = 'completed';
    const STATUS_OCCURING = 'occuring';
    const STATUS_DELAYED = 'delayed';
    const STATUS_100_PERCENT = '100';
    const STATUS_ALL = 'all';
    
    const ROLE_ALL = 'all';
    const ROLE_CREATOR = 'creator';
    const ROLE_ASSIGNEE = 'assignee';

    public $id;
    public $title;
    public $description;

    /**
     *
     * @var UserEntity
     */
    public $creator;

    /**
     *
     * @var UserEntity
     */
    public $assignee;

    /**
     *
     * @var OrganizationUnitEntity
     */
    public $org_unit;

    /**
     *
     * @var ActivityEntity
     */
    public $parent;

    /**
     *
     * @var \DateTime
     */
    public $created_at;

    /**
     *
     * @var \DateTime
     */
    public $assigning_time;

    /**
     *
     * @var \DateTime
     */
    public $deadline;

    /**
     *
     * @var \DateTime
     */
    public $completed_time;
    public $is_valid;
    public $progress;
    public $creator_comment;

    public function status_label()
    {
	switch ($this->status())
	{
	    case ActivityEntity::STATUS_COMPLETED:
		return "success";
	    case ActivityEntity::STATUS_OCCURING:
		return "info";
	    case ActivityEntity::STATUS_DELAYED:
		return "important";
	}
    }

    public function status_progress_label()
    {
	switch ($this->status())
	{
	    case ActivityEntity::STATUS_COMPLETED:
		return "success";
	    case ActivityEntity::STATUS_OCCURING:
		return "info";
	    case ActivityEntity::STATUS_DELAYED:
		return "danger";
	}
    }

    public function status()
    {
	$today = new \DateTime;
	if ($this->completed_time)
	    return ActivityEntity::STATUS_COMPLETED;
	if ($this->deadline > $today)
	    return ActivityEntity::STATUS_OCCURING;
	else
	    return ActivityEntity::STATUS_DELAYED;
    }

}

?>
