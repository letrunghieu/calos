<?php

use Navigation\NavagationItem;
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
    
    public function test_namespace(){
	$instance = new NavagationItem("Foo", "#foo");
	$this->assertTrue($instance instanceof NavagationItem );
    }
    
    public function test_render_link_noactivate()
    {
	$options = array(
	    #'before_element' => '<div>',
	    #'after_element' => '</div>'
	);
	$instance = new Navigation\NavagationItem("Foo", "#foo", FALSE, FALSE, $options);
	$expected = <<<HTML
<li class="navigation_item ">
<a title="" href="#foo">Foo</a>
</li>
HTML;
	$this->assertEquals(trim($expected), trim($instance->render()));
    }
}

?>
