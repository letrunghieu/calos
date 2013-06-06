<?php

namespace CALOS\Repositories;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class UserRepository
{

    public static function find_by_email($email)
    {
	$user = \User::where('email', '=', $email)->first();
	if ($user)
	{
	    $user_entity = static::convert_from_orm($user);
	    return $user_entity;
	} else
	{
	    return null;
	}
    }

    public static function paginate_from_vacancies($vacancy_ids, &$paginator, $sort = 'display_name', $order = 'asc')
    {
	$paginator = \DB::table('users')
		->left_join('user_vacancy', 'user_vacancy.user_id', '=', 'users.id')
		->where_in('user_vacancy.vacancy_id', $vacancy_ids)
		->where('users.is_valid', '=', true)
		->order_by("users.{$sort}", $order)
		->paginate(\Config::get('calos.item_per_page', 20));
	return array_map(function($user)
		{
		    return static::convert_from_orm($user);
		}, (array) $paginator->results);
    }

    public static function paginate_from_unit_members($unit_id, &$paginator, $sort = 'display_name', $order = 'asc')
    {
	$vacancy = \Vacancy::where('organizationunit_id', '=', $unit_id)
		->where('order', '=', 1000)
		->first();
	$paginator = \DB::table('users')
		->left_join('user_vacancy', 'user_vacancy.user_id', '=', 'users.id')
		->where('user_vacancy.vacancy_id', '=', $vacancy->id)
		->where('users.is_valid', '=', true)
		->order_by("users.{$sort}", $order)
		->paginate(\Config::get('calos.item_per_page', 20), array('users.id', 'users.display_name', 'users.first_name', 'users.email', 'users.mobile_phone'));
	return array_map(function($user)
		{
		    $user_entity = new \CALOS\Entities\UserEntity($user->id);

		    $user_entity->display_name = $user->display_name ? $user->display_name : $user->first_name . " " . $user->last_name;
		    $user_entity->first_name = $user->first_name;
		    $user_entity->email = $user->email;
		    $user_entity->mobile_phone = $user->mobile_phone;
		    return $user_entity;
		}, (array) $paginator->results);
    }

    public static function get_unit_members($unit_id)
    {
	$vacancy = \Vacancy::where('organizationunit_id', '=', $unit_id)
		->where('order', '=', 1000)
		->first();
	if (!$vacancy)
	{
	    var_dump($unit_id);
	}
	return array_map(function($item)
		{
		    $entity = new \CALOS\Entities\UserEntity($item->id);
		    $entity->display_name = $item->display_name;
		    return $entity;
		}, \DB::table('users')
			->left_join('user_vacancy', 'user_vacancy.user_id', '=', 'users.id')
			->where('user_vacancy.vacancy_id', '=', $vacancy->id)
			->where('users.is_valid', '=', true)
			->order_by('users.display_name')
			->group_by('users.id')
			->get(array('users.id', 'users.display_name', 'users.first_name', 'users.email', 'users.mobile_phone')));
    }

    /**
     * 
     * @param type $id
     * @return \CALOS\Entities\UserEntity
     */
    public static function find_by_id($id)
    {
	$user = \User::find($id);
	if ($user)
	{
	    $user_entity = static::convert_from_orm($user);
	    return $user_entity;
	} else
	{
	    return null;
	}
    }

    public static function create($email, $password, $first_name, $last_name)
    {
	$user = \User::where('email', '=', $email)->first();
	if ($user)
	    return false;
	$user = \User::create(array(
		    'email' => $email,
		    'password' => $password,
		    'first_name' => $first_name,
		    'last_name' => $last_name,
		    'display_name' => $first_name . " " . $last_name,
	));
	OrganizationUnitRepository::add_member(1, $user->id);
	return static::convert_from_orm($user);
    }

    public static function save(\CALOS\Entities\UserEntity $user_entity)
    {
	$user = \User::find($user_entity->get_id());
	if ($user)
	{
	    $user->display_name = $user_entity->display_name;
	    $user->first_name = $user_entity->first_name;
	    $user->last_name = $user_entity->last_name;
	    $user->email = $user_entity->email;
	    $user->password = $user_entity->password;
	    $user->new_pass_token = $user_entity->new_pass_token;
	    $user->mobile_phone = $user_entity->mobile_phone;
	    $user->home_phone = $user_entity->home_phone;
	    $user->office_phone = $user_entity->office_phone;
	    $user->address = $user_entity->address;
	    $user->gender = $user_entity->gender;

	    $user->save();
	    return true;
	}
	return false;
    }

    /**
     * Get the current user entity
     * 
     * @return \CALOS\Entities\UserEntity
     */
    public static function current_user()
    {
	if (\Auth::guest())
	{
	    return null;
	} else
	{
	    return static::convert_from_orm(\Auth::user());
	}
    }

    public static function who_read_announcement($announcement_id, &$paginator, $is_read = true)
    {
	$query = \AnnouncementReply::with('user')
		->where('announcement_id', '=', $announcement_id)
		->where('is_read', '=', $is_read);
	$paginator = $query->paginate(\Config::get('calos.item_per_page', 20));
	$result = array();
	foreach ((array) $paginator->results as $q)
	{
	    $result[] = array(
		'user' => UserRepository::convert_from_orm($q->user),
		'time' => new \DateTime($q->updated_at),
	    );
	}
	return $result;
    }

    public static function convert_from_orm($user)
    {
	return \CALOS\Services\ConvertService::to_entity($user, function($item)
			{
			    $user = $item;
			    $user_entity = new \CALOS\Entities\UserEntity($user->id);

			    $user_entity->display_name = $user->display_name ? $user->display_name : $user->first_name . " " . $user->last_name;
			    $user_entity->first_name = $user->first_name;
			    $user_entity->last_name = $user->last_name;
			    $user_entity->email = $user->email;
			    $user_entity->password = $user->password;
			    $user_entity->new_pass_token = $user->new_pass_token;
			    $user_entity->mobile_phone = $user->mobile_phone;
			    $user_entity->home_phone = $user->home_phone;
			    $user_entity->office_phone = $user->office_phone;
			    $user_entity->address = $user->address;
			    $user_entity->gender = $user->gender;

			    return $user_entity;
			});
    }

}
