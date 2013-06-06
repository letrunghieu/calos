<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of announcementreply
 *
 * @author TrungHieu
 */
class AnnouncementReply extends Basemodel
{
    public static $table = "user_announcement";
    public static $timestamps = true;
    
    public function user()
    {
	return $this->belongs_to('User', 'user_id');
    }
}

?>
