<?php

/**
 * SEO Library
 * Config and display the SEO header for a web page:
 *  - title
 *  - meta description
 * 
 * @author Hieu Le <letrunghieu.cse09@gmail.com>
 * @package CALOS
 * @subpackage Libraries
 */
class SEO
{
    /**
     * A singleton instance, each page has only one instance of this class
     *
     * @var SEO 
     */
    private static $_instance;

    /**
     * The title of this page
     *
     * @var string
     */
    private $_title;

    /**
     * The meta description of this page
     *
     * @var string 
     */
    private $_description;
    
    private static $_app_name = "CALOS";
    
    public static function set_title($title, $append_app_name = true)
    {
	SEO::_get_instance()->_title = ( $append_app_name ? SEO::$_app_name . " :: " : "" ) . htmlentities($title);
    }
    
    public static function set_description($descr)
    {
	SEO::_get_instance()->_description = htmlentities($descr);
    }

    public static function headers()
    {
	$output = "";
	$instance = SEO::_get_instance();
	if ($instance->_title)
	    $output .= "<title>{$instance->_title}</title>\n";
	if ($instance->_description)
	    $output .= "<meta name='description' content='{$instance->_description}'></meta>\n";
	
	return $output;
    }

    private static function _get_instance()
    {
	if (!SEO::$_instance)
	    SEO::$_instance = new SEO();
	return SEO::$_instance;
    }

}