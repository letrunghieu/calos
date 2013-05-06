<?php

use Navigation\NavagationItem;
use Navigation\NavagationContainer;
use Navigation\Navagation;

/**
 * Description of NavigationItemTest
 *
 * @author TrungHieu
 */
class NavigationItemTest extends PHPUnit_Framework_TestCase
{

    public function __construct()
    {
	Laravel\Bundle::start('navigation');
    }

    public function test_namespace()
    {
	$instance = new NavagationItem("Foo", "#foo");
	$this->assertTrue($instance instanceof NavagationItem);
    }

//    public function test_render_link_noactivate()
//    {
//	$options = array(
//	    #'before_element' => '<div>',
//	    #'after_element' => '</div>'
//	);
//	$instance = new Navigation\NavagationItem("Foo", "#foo", FALSE, FALSE, $options);
//	$expected = <<<HTML
//<li class="navigation_item ">
//<a title="" href="#foo">Foo</a>
//</li>
//HTML;
//	$this->assertEquals(trim($expected), trim($instance->render()));
//    }

    public function test_main()
    {
	$options = array(
	    array(
		'before_element' => '<div class="out">',
		'after_element' => '</div>',
		'element_attribs' => array('class' => 'nav1', 'data_foo' => 'dfoo'),
		'item_template' => array(
		    'before_link' => '<span>',
		    'after_link' => '</span>',
		    'element_attribs' => array(),
		    'link_attribs' => array(),
		),
	    ),
	    array(
		'after_element' => '</div>',
		'element_attribs' => array('data_bar' => 'dbar'),
		'item_template' => array(
		    'before_link' => '<p>',
		    'after_link' => '</p>',
		),
	    )
	);

	$topbar = \Navigation\Navigation::make('topbar')
		->add_link('foo', '#foo')
		->add_link(
		'bar', '#bar', false, array(), \Navigation\Navigation::make('', array(), false)
		->add_link('child_foo', '#child_foo')
		->add_link(
			'child_bar', '#cbar', FALSE, array(), \Navigation\Navigation::make('', array(), false)
			->add_link('yahoo', '#yahoo')
		)
	);
	echo "OUTPUT: \n";
	echo $topbar->render($options);
    }

}

?>
