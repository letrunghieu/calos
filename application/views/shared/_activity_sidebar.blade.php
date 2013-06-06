<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$action = \Laravel\Request::route()->controller_action;
?>

<ul class='nav nav-tabs nav-stacked'>
    <li class='{{$action == "view" ? "active" : ""}}'>
	<a href='{{URL::to_action("activity@view", array($activity->id))}}'>{{__('activity.view activity')}}</a>
    </li>
    <li class='{{$action == "edit" ? "active" : ""}}'>
	<a href='{{URL::to_action("activity@edit", array($activity->id))}}'>{{__('activity.edit activity')}}</a>
    </li>
    <li class='{{$action == "delete" ? "active" : ""}}'>
	<a href='{{URL::to_action("activity@delete", array($activity->id))}}'>{{__('activity.delete activity')}}</a>
    </li>
    <li>
	<a href='{{URL::to_action("organization@unit_activities", array($activity->org_unit->id))}}'>{{__('activity.activities in unit')}}</a>
    </li>
    <li>
	<a href='{{URL::to_action("activity@user", array($user->id))}}'>{{__('activity.my activities')}}</a>
    </li>
</ul>
