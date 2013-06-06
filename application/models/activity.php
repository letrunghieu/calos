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
class Activity extends Basemodel
{
    public static $timestamps = true;
    
    public function creator()
    {
	return $this->belongs_to('User', 'creator_id');
    }
    
    public function assigneee()
    {
	return $this->belongs_to('User', 'assignee_id');
    }
    
    public function org_unit()
    {
	return $this->belongs_to('OrganizationUnit', 'organizationunit_id');
    }
    
    public function parent_activity()
    {
	return $this->belongs_to('Activity', 'parent_id');
    }
    
    public function child_activities()
    {
	return $this->has_many('Activity', 'parent_id');
    }
}

?>
