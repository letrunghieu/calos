<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$action = \Laravel\Request::route()->controller_action;
?>

<ul class='nav nav-list'>
    <li class="nav-header">{{__('announcement.navigation title')}}</li>
    <li class='{{in_array($action, array("view")) ? "active" : ""}}'>
	<a href='{{URL::to_action("announcement@view", array($announcement->id))}}'>{{__('announcement.view announcement')}}</a>
    </li>
    <li class='{{in_array($action, array("view_read")) ? "active" : ""}}'>
	<a href='{{URL::to_action("announcement@view_read", array($announcement->id))}}'>{{__('announcement.view announcement read')}}</a>
    </li>
    <li class='{{in_array($action, array("view_unread")) ? "active" : ""}}'>
	<a href='{{URL::to_action("announcement@view_unread", array($announcement->id))}}'>{{__('announcement.view announcement unread')}}</a>
    </li>
</ul>
