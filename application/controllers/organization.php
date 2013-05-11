<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Organization_Controller extends Base_Controller
{

    public function __construct()
    {
	parent::__construct();
    }

    public function action_index()
    {
	$data = array();
	SEO::set_title('View our organization structure');
	return View::make('organization.index', $data);
    }

    public function action_view_unit($unit_id)
    {
	$data = array();
	return View::make('organization.view_unit', $data);
    }

    public function action_view_unit_vacancy($unit_id)
    {
	$data = array();
	return View::make('organization.view_unit_vacancy', $data);
    }

    public function action_edit_unit($unit_id)
    {
	$data = array();
	return View::make('organization.edit_unit', $data);
    }

    public function action_edit_unit_vacancy($unit_id)
    {
	$data = array();
	return View::make('organization.edit_unit_vacancy', $data);
    }

    public function action_edit_unit_member($unit_id)
    {
	$data = array();
	return View::make('organization.edit_unit_member', $data);
    }

}
