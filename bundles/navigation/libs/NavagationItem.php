<?php

namespace Navigation;

use Navigation\NavigationContainer;

/**
 * Description of NavagationItem
 *
 * @author TrungHieu
 */
class NavagationItem
{

    /**
     * The content of the anchor element
     *
     * @var string 
     */
    private $_link;

    /**
     * The URL this element linking to, maybe null
     *
     * @var string 
     */
    private $_url;

    /**
     * If this is a raw navigation item, the anchor element will not added and 
     * the <code>$_link</code> memeber will be used as the raw content
     *
     * @var boolean
     */
    private $_is_raw;

    /**
     * Whether this item is activated
     *
     * @var boolean
     */
    private $_is_activate;

    /**
     * The sub navigation - an instance of the NavigationContainer class
     *
     * @var NavigationContainer
     */
    private $_child;

    /**
     * The option for the <code>render()</code> method. This option will 
     * overides option passed from its container.
     *
     * @var mixed 
     */
    private $_options;

    /**
     * The parent item of this item
     *
     * @var \Navigation\NavigationContainer
     */
    private $_parent;

    /**
     * Create new navigation item, it may or maynot contains sub navigation
     * 
     * @param string $link  The content of the anchor element or the raw content
     * @param string $url   The href of the anchor element
     * @param string $title The title of the anchor element
     * @param boolean $is_raw	Whether this is a raw item or not
     * @param boolean $is_activate  Whether this item is selected or not
     * @param mixed $options	Inline rendering options
     * @param NavigationContainer $child    Its sub navigation
     */
    public function __construct($link, $url, $is_raw = false, $is_activate = false, $options = array(), $child = null)
    {
	$this->_link = $link;
	$this->_url = $url;
	$this->_is_raw = $is_raw;
	$this->_is_activate = $is_activate;
	$this->_options = $options;
	$this->_child = $child;
	if ($this->_child)
	    $this->_child->set_parent($this);
    }

    /**
     * Set the parent item for this item
     * 
     * @param \Navigation\NavigationContainer $item	the parent container
     */
    public function set_parent(\Navigation\NavigationContainer $item)
    {
	$this->_parent = $item;
    }

    /**
     * Get the parent item of this item
     * 
     * @return \Navigation\NavigationContainer
     */
    public function get_parent()
    {
	return $this->_parent;
    }

    /**
     * Activate this item
     */
    public function activate()
    {
	$this->_is_activate = true;

	return $this;
    }

    /**
     * Deselect this item and all of its children
     */
    public function reset()
    {
	$this->_is_activate = FALSE;
	if ($this->_child)
	    $this->_child->reset();
    }

    /**
     * 
     * @param type $name
     * @param type $options
     * @return \Navigation\NavigationContainer
     */
    public function make_child($name = '', $options = array())
    {
	$container = new NavigationContainer($name, $options);
	$this->_child = $container;
	$container->set_parent($this);
	return $container;
    }

    /**
     * 
     * @return \Navigation\NavigationContainer
     */
    public function get_child()
    {
	return $this->_child;
    }

    /**
     * 
     * @param type $name
     * @param type $options
     * @return \Navigation\NavigationContainer
     */
    public function get_child_or_create($name = '', $options = array())
    {
	if (!$this->_child)
	{
	    $container = new NavigationContainer($name, $options);
	    $this->_child = $container;
	    $container->set_parent($this);
	}
	return $this->_child;
    }

    /**
     * Find a navigation item by its name
     * 
     * @param string $name
     * @return Navigation\NavagationItem|null
     */
    public function find_item($name)
    {
	if ($this->_child)
	    return $this->_child->find_item($name);
	else
	    return null;
    }

    /**
     * Find a navigation container by its name
     * 
     * @param string $name
     * @return Navigation\NavigationContainer |null
     */
    public function find_container($name)
    {
	if ($this->_child)
	    return $this->_child->find_item($name);
	else
	    return null;
    }

    /**
     * Render this item into HTML code with an option array
     * 
     * @param mixed $options	The rendering option passed to this element.
     * 				
     */
    public function render($options = array(), $child_template = array(), $depth = 0)
    {
	$indent = $depth ? str_repeat('    ', $depth) : "";
	$default = array(
	    'element' => 'li',
	    'before_element' => '',
	    'after_element' => '',
	    'before_link' => '',
	    'after_link' => '',
	    'before_item' => '',
	    'after_item' => '',
	    'element_attribs' => array(),
	    'link_attribs' => array(),
	);

	$options = array_merge($default, $options);
	$options = array_merge($options, $this->_options);
	$element_classes = "navigation_item" . ($this->_is_activate ? "active" : "");
	if (isset($options['element_attribs']['class']))
	    $options['element_attribs']['class'] = $element_classes . " " . $options['element_attribs']['class'];
	else
	    $options['element_attribs']['class'] = $element_classes;
	$element_attribs = \Laravel\HTML::attributes($options['element_attribs']);
	$anchor_content = $this->_link;
	if (!isset($options['link_attribs']['title']))
	    $options['link_attribs']['title'] = '';
	if ($this->_url !== null)
	{
	    $options['link_attribs']['href'] = $this->_url;
	}
	$anchor_attribs = \Laravel\HTML::attributes($options['link_attribs']);
	if (!$this->_is_raw)
	{
	    $item_content = "<a{$anchor_attribs}>{$options['before_item']}{$anchor_content}{$options['after_item']}</a>";
	} else
	{
	    $item_content = $this->_link;
	}

	$output = "\n";
	$output .= "{$indent}{$options['before_element']}\n";
	$output .= "{$indent}<{$options['element']}{$element_attribs}>\n";
	$output .= "{$indent}{$options['before_link']}{$item_content}{$options['after_link']}\n";
	if ($this->_child)
	    $output .= $this->_child->render($child_template, $depth);
	$output .= "{$indent}</{$options['element']}>\n";
	$output .= "{$indent}{$options['after_element']}\n";
	return $output;
    }

}

?>
