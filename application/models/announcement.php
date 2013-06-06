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
class Announcement extends Basemodel
{
    public static $timestamps = true;
    
    public function org_unit()
    {
	return $this->belongs_to('OrganizationUnit', 'organizationunit_id');
    }
}

?>
