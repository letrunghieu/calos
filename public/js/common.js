/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

(function() {
    function setBodyHeight()
    {
	var bodyHeight = $('body').height();
	var windowHeight = $(window).innerHeight();
	if (bodyHeight < windowHeight)
	{
	    $('.page.valign').css('position', 'relative');
	    $('.page.valign').css('top', (windowHeight - bodyHeight) / 2.5);
	    $('body').height(windowHeight);
	}


    }
    $(document).ready(function() {
	setBodyHeight();
	$(window).resize(setBodyHeight());
    });
})();

/**
 * Message UI module for gumby
 * @returns {undefined}
 */
(function() {
    $(document).ready(function() {
	
    });

})();


