<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$action = \Laravel\Request::route()->controller_action;
?>

<ul class='nav nav-tabs nav-stacked'>
    <li class='{{$action == "view_profile" ? "active" : ""}}'>
	<a href='{{URL::to_action("user@view_profile", array($user->id))}}'>{{__('user.view profile')}}</a>
    </li>
    <li class='{{$action == "user_vacancies" ? "active" : ""}}'>
	<a href='{{URL::to_action("organization@user_vacancies", array($user->id))}}'>{{__('organization.user vacancies')}}</a>
    </li>
    <li class='{{$action == "user" ? "active" : ""}}'>
	<a href='{{URL::to_action("activities@user", array($user->id))}}'>{{__('activity.user activities')}}</a>
    </li>
</ul>
