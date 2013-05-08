/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

(function($) {
    var methods = {
	init: function(options) {
	},
	show: function(options) {
	    var settings = $.extend({
		'successHandler': null,
		'successData': null
	    }, options);

	    var bodyHeight = $('body').height();
	    var windowHeight = $(window).innerHeight();
	    var messageObj = this.clone().addClass('show');
	    var container = $('<div id="messages_conatainer"/>')
		    .css('position', 'fixed')
		    .css('top', 0)
		    .css('width', '100%')
		    .css('height', windowHeight)
		    .css('background', 'rgba(80,80,80,0.75)')
		    .appendTo('body');
	    var inner = $('<div  class="container shaded" />')
		    .css('position', 'relative')
		    .css('padding', '20px')
		    .css('box-shadow', '0 0 2px #474747')
		    .appendTo(container);
	    messageObj.appendTo(inner);
	    inner.css('top', (windowHeight - inner.height()) / 2.5);
	    if (settings.successHandler)
		messageObj.find('.button_confirm').click(settings.successData, settings.successHandler);
	    messageObj.find('.button_cancel').click(methods.hide);
	    container.click(methods.hide);
	    inner.click(function(event){
		event.stopPropagation();
	    });
	},
	hide: function( ) {
	    $('#messages_conatainer').remove();
	}
    };

    $.fn.message = function(method) {

	// Method calling logic
	if (methods[method]) {
	    return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
	} else if (typeof method === 'object' || !method) {
	    return methods.init.apply(this, arguments);
	} else {
	    $.error('Method ' + method + ' does not exist on jQuery.tooltip');
	}

    };
})(jQuery);
