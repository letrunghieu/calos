<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$action = \Laravel\Request::route()->controller_action;
?>

<ul class='nav nav-list'>
    <li class="nav-header">{{__('organization.navigation title')}}</li>
    <li class='{{in_array($action, array("view_unit", "index")) ? "active" : ""}}'>
	<a href='{{URL::to_action("organization@view_unit", array($org_unit->id))}}'>{{__('organization.view unit')}}</a>
    </li>
    <li class="{{$action == "unit_activities" ? "active" : ""}}">
	<a href='{{URL::to_action("organization@unit_activities", array($org_unit->id))}}'>{{__('organization.unit activities')}}</a>
    </li>
    <li class='{{$action == "unit_announcements" ? "active" : ""}}'>
	<a href='{{URL::to_action("organization@unit_announcements", array($org_unit->id))}}'>{{__('organization.unit announcements')}}</a>
    </li>
    <li class='{{$action == "unit_members" ? "active" : ""}}'>
	<a href='{{URL::to_action("organization@unit_members", array($org_unit->id))}}'>{{__('organization.unit members')}}</a>
    </li>
    <li class='{{$action == "edit_unit" ? "active" : ""}}'>
	<a href='{{URL::to_action("organization@edit_unit", array($org_unit->id))}}'>{{__('organization.edit unit')}}</a>
    </li>
    <li class='{{$action == "remove_unit" ? "active" : ""}}'>
	<a href='{{URL::to_action("organization@remove_unit", array($org_unit->id))}}'>{{__('organization.remove unit')}}</a>
    </li>
</ul>
