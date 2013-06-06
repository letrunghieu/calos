<?php

namespace CALOS\Repositories;

use CALOS\Entities\AnnouncementEntity;

/**
 * Description of AnnouncementRepository
 *
 * @author TrungHieu
 */
class AnnouncementRepository
{

    public static function create($title, $content, $user_id, $org_unit_id)
    {
	$recievers = UserRepository::get_unit_members($org_unit_id);
	$announcement = \Announcement::create(array(
		    'title' => $title,
		    'content' => $content,
		    'creator_id' => $user_id,
		    'organizationunit_id' => $org_unit_id,
	));
	foreach ($recievers as $r)
	{
	    \AnnouncementReply::create(array(
		'user_id' => $r->id,
		'announcement_id' => $announcement->id,
	    ));
	}
    }

    public static function get_latest($user_id, $number = NULL)
    {
	if (!$number)
	    $number = \Config::get('number_latest', 5);
	$result = \DB::table('user_announcement')
		->left_join('users', 'user_announcement.user_id', '=', 'users.id')
		->left_join('announcements', 'user_announcement.announcement_id', '=', 'announcements.id')
		->left_join('organizationunits', 'announcements.organizationunit_id', '=', 'organizationunits.id')
		->group_by('announcements.id')
		->order_by('announcements.created_at', 'desc')
		->take($number)
		->get(array(
	    'announcements.creator_id',
	    'users.display_name',
	    'users.email',
	    'announcements.organizationunit_id',
	    'organizationunits.name',
	    'announcements.id',
	    'announcements.title',
	    'announcements.content',
	    'announcements.created_at',
	    'user_announcement.is_read',
	));
	return static::convert_from_orm($result);
    }

    public static function convert_from_orm($input)
    {
	return \CALOS\Services\ConvertService::to_entity($input, function($item)
			{
			    $input = $item;
			    $entity = new AnnouncementEntity;
			    $creator = new \CALOS\Entities\UserEntity;
			    $creator->id = $input->creator_id;
			    $creator->display_name = $input->display_name;
			    $creator->email = $input->email;

			    $unit = new \CALOS\Entities\OrganizationUnitEntity;
			    $unit->id = $input->organizationunit_id;
			    $unit->name = $input->name;

			    $entity->id = $input->id;
			    $entity->title = $input->title;
			    $entity->content = $input->content;
			    $entity->creator = $creator;
			    $entity->org_unit = $unit;
			    $entity->created_at = $input->created_at;

			    if (isset($input->is_read))
				$entity->is_read = $input->is_read;

			    return $entity;
			});
    }

}

?>
