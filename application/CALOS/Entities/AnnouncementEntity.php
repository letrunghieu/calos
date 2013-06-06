<?php namespace CALOS\Entities;

/**
 * Description of AnnouncementEntity
 *
 * @author TrungHieu
 */
class AnnouncementEntity
{
    const STATUS_ALL = 'all';
    const STATUS_READ = 'read';
    const STATUS_UNREAD = 'unread';
    
    const ROLE_ALL = 'all';
    const ROLE_SENDER = 'sender';
    const ROLE_RECEIVER = 'receiver';
    
    public $id;
    public $title;
    public $content;
    public $creator;
    public $org_unit;
    public $created_at;
    public $is_read;
}

?>
