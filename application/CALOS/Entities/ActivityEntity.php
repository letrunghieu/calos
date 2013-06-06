<?php namespace CALOS\Entities;

/**
 * Description of ActivityEntity
 *
 * @author TrungHieu
 */
class ActivityEntity
{
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
}

?>
