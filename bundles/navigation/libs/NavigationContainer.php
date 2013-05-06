<?php

namespace Navigation;

use Navigation\NavagationItem;

/**
 * Description of NavigationContainer
 *
 * @author TrungHieu
 */
class NavigationContainer
{

    /**
     * The navigation items of this container
     *
     * @var mixed
     */
    private $_items;

    /**
     * The rendering options of this container
     *
     * @var mixed 
     */
    private $_options;

    /**
     * The name of this container;
     *
     * @var type 
     */
    private $_name;
    
    /**
     * The parent item of this container
     *
     * @var \Navigation\NavagationItem 
     */
    private $_parent;

    /**
     * Create new container
     * 
     * @param string $name  The name of this container
     * @param mixed $options	The rendering options
     */
    public function __construct($name = '', $options = array())
    {
	$this->_name = $name;
	$this->_options = $options;
	$this->_items = array();
    }

    /**
     * Deselect all items and their child navigation
     */
    public function reset()
    {
	/* @var $item \Navigation\NavagationItem */
	foreach ($this->_items as $item)
	{
	    
	}
    }

    /**
     * Remove all items and child elements
     */
    public function truncate()
    {
	$this->_items = array();
    }
    
    /**
     * Set the parent item for this container
     * 
     * @param \Navigation\NavagationItem $item	the parent item
     */
    public function set_parent(\Navigation\NavagationItem $item)
    {
	$this->_parent = $item;
    }
    
    /**
     * Get the parent item of this container
     * 
     * @return \Navigation\NavagationItem
     */
    public function get_parent()
    {
	return $this->_parent;
    }

    /**
     * Add a new link item into this container
     * 
     * @param string $link  the content of the anchor element
     * @param string $url   the url this item linking to
     * @param boolean $is_activate  is this item seleted
     * @param mixed $options	rendering options
     * @param NavigationContainer $child    the child navigation in this item
     * @param string $name  if exist, the unique name of this item
     * @return NavigationContainer
     */
    public function add_link($link, $url, $is_activate = false, $options = array(), $child = null, $name = null)
    {
	$item = new NavagationItem($link, $url, FALSE, $is_activate, $options, $child);
	$item->set_parent($this);
	if ($name === null)
	{
	    $this->_items[] = $item;
	} else
	{
	    $this->_items[$name] = $item;
	}
	return $this;
    }

    /**
     * Create an raw item in this container
     * 
     * @param string $link  the content of the anchor element
     * @param boolean $is_activate  is this item seleted
     * @param mixed $options	rendering options
     * @param NavigationContainer $child    the child navigation in this item
     * @param string $name  if exist, the unique name of this item
     * @return \Navigation\NavigationContainer
     */
    public function add_raw($link, $is_activate = false, $options = array(), $child = null, $name = null)
    {
	$item = new NavagationItem($link, '', TRUE, $is_activate, $options, $child);
	$item->set_parent($this);
	if ($name === null)
	{
	    $this->_items[] = $item;
	} else
	{
	    $this->_items[$name] = $item;
	}
	return $this;
    }

    /**
     * Return an item with the key <code>$id</code>. The <code>$id</code> can be 
     * a string or an integer.
     * 
     * @param mixed $id
     * @return \Navigation\NavagationItem
     */
    public function item($id)
    {
	if (isset($this->_items[$id]))
	{
	    return $this->_items[$id];
	}
	else
	    return NULL;
    }

    /**
     * Find an element by its name
     * 
     * @param string $name  the name of the item object
     * @return \Navigation\NavagationItem|null
     */
    public function find_item($name)
    {
	if (key_exists($name, $this->_items))
	    return $this->_items[$name];
	$result = null;
	/* @var $item \Navigation\NavagationItem */
	foreach ($this->_items as $item)
	{
	    $result = $item->find_item($name);
	    if ($result != null)
		return $result;
	}
	return $result;
    }

    /**
     * Find a container by its name
     * 
     * @param string $name  the name of the container object
     * @return \Navigation\NavigationContainer|null
     */
    public function find_container($name)
    {
	if ($this->_name == $name)
	    return $this;
	else
	{
	    $result = null;
	    /* @var $item \Navigation\NavagationItem */
	    foreach ($this->_items as $item)
	    {
		$result = $item->find_container($name);
		if ($result != null)
		    return $result;
	    }
	    return $result;
	}
    }
    
    public function render($options = array(), $depth = 0)
    {
	$indent = $depth ? str_repeat('    ', $depth) : "";
	$default = array(
	    'element' => 'ul',
	    'before_element' => '',
	    'after_element' => '',
	    'element_attribs' => array(),
	    'item_template' => array(),
	);
	if (isset($options[0]))
	{
	    $opt = array_shift($options);
	    if (empty($options))
	    {
		$options = array_merge(array(), $opt);
	    }
	}
	else
	{
	    $opt = $options;
	}
	$opt = \Parameter::array_merge($default, $opt);
	$opt = \Parameter::array_merge($opt, $this->_options);
	
	$element_calsses = "navigation_container";
	if (isset($opt['element_attribs']['class']))
	    $opt['element_attribs']['class'] = $element_calsses . " " . $opt['element_attribs']['class'] ;
	$element_attribs = \Laravel\HTML::attributes($opt['element_attribs']);
	
	$output = "";
	$output .= "{$indent}{$opt['before_element']}\n";
	$output .= "{$indent}<{$opt['element']}{$element_attribs}>\n";
	/* @var $item \Navigation\NavagationItem */
	foreach($this->_items as $item)
	{
	    $output .= $item->render($opt['item_template'], $options, $depth + 1);
	}
	$output .= "{$indent}</{$opt['element']}>\n";
	$output .= "{$indent}{$opt['after_element']}\n";
	
	return $output;
    }

}

?>
