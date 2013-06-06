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

    public static function get_by_id($id)
    {
	$announcement = \Announcement::find($id);
	return \CALOS\Services\ConvertService::to_entity($announcement, function($item)
			{
			    $entity = new AnnouncementEntity;
			    $entity->id = $item->id;
			    $entity->title = $item->title;
			    $entity->content = $item->content;
			    $entity->created_at = $item->created_at ? new \DateTime($item->created_at) : NULL;

			    $entity->creator = UserRepository::convert_from_orm($item->creator);
			    $entity->org_unit = OrganizationUnitRepository::convert_from_orm($item->org_unit);
			    return $entity;
			});
    }

    public static function paginate_unit_announcement($unit_id, &$paginator, $options = array())
    {
	$default = array(
	    'sort' => 'created_at',
	    'order' => 'asc',
	    'per_page' => \Config::get('calos.item_per_page', 20),
	);

	$options = array_merge($default, $options);
	$today = new \DateTime();
	$query = \DB::table('announcements')
		->left_join('users', 'announcements.creator_id', '=', 'users.id')
		->left_join('organizationunits', 'announcements.organizationunit_id', '=', 'organizationunits.id')
		->where('announcements.organizationunit_id', '=', $unit_id);

	$paginator = $query->order_by('announcements.' . $options['sort'], $options['order'])
		->paginate($options['per_page'], array(
	    'announcements.id',
	    'announcements.creator_id',
	    'users.display_name',
	    'users.email',
	    'announcements.organizationunit_id',
	    'organizationunits.name',
	    'announcements.title',
	    'announcements.content',
	    'announcements.created_at',
	));
	return (array) static::convert_from_orm($paginator->results);
    }

    public static function paginate_user_announcement($user_id, &$paginator, $options = array())
    {
	$default = array(
	    'sort' => 'created_at',
	    'order' => 'asc',
	    'filter' => AnnouncementEntity::STATUS_ALL,
	    'per_page' => \Config::get('calos.item_per_page', 20),
	    'role' => AnnouncementEntity::ROLE_RECEIVER,
	    'unit' => 0,
	);

	$options = array_merge($default, $options);
	$today = new \DateTime();
	$query = \DB::table('user_announcement')
		->left_join('users', 'user_announcement.user_id', '=', 'users.id')
		->left_join('announcements', 'user_announcement.announcement_id', '=', 'announcements.id')
		->left_join('organizationunits', 'announcements.organizationunit_id', '=', 'organizationunits.id');
	switch ($options['role'])
	{
	    case AnnouncementEntity::ROLE_SENDER:
		$query->where('announcements.creator_id', '=', $user_id);
		break;
	    case AnnouncementEntity::ROLE_RECEIVER:
		$query->where('user_announcement.user_id', '=', $user_id);
		break;
	}
	switch ($options['filter'])
	{
	    case AnnouncementEntity::STATUS_READ:
		$query->where('user_announcement.is_read', '=', true);
		break;
	    case AnnouncementEntity::STATUS_UNREAD:
		$query->where('user_announcement.is_read', '=', false);
		break;
	}

	if ($options['unit'])
	{
	    $query->where('announcements.organizationunit_id', '=', $options['unit']);
	}



	$paginator = $query->order_by('announcements.' . $options['sort'], $options['order'])
		->paginate($options['per_page'], array(
	    'announcements.id',
	    'announcements.creator_id',
	    'users.display_name',
	    'users.email',
	    'announcements.organizationunit_id',
	    'organizationunits.name',
	    'announcements.title',
	    'announcements.content',
	    'announcements.created_at',
	    'user_announcement.is_read',
	));
	return (array) static::convert_from_orm($paginator->results);
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

    public static function user_can_read($user_id, $announcement_id)
    {
	$obj = \AnnouncementReply::where('user_id', '=', $user_id)
		->where('announcement_id', '=', $announcement_id)
		->first();
	if (!$obj)
	    return false;
	return true;
    }

    public static function user_read_time($user_id, $announcement_id)
    {
	$obj = \AnnouncementReply::where('user_id', '=', $user_id)
		->where('announcement_id', '=', $announcement_id)
		->first();
	if ($obj && $obj->is_read)
	    return new \DateTime($obj->updated_at);
    }

    public static function confirm_read($user_id, $announcement_id)
    {
	$obj = \AnnouncementReply::where('user_id', '=', $user_id)
		->where('announcement_id', '=', $announcement_id)
		->first();
	if ($obj && !$obj->is_read)
	{
	    $obj->is_read = true;
	    $obj->save();
	}
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
