/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

(function() {
    function close_button_handler(ele)
    {
	var element = $(ele.currentTarget);
	if (element.hasClass('show'))
	{
	    element.parents('.template-field').find('.content').hide();
	    element.removeClass('show');
	    element.find('i').removeClass('icon-minus').addClass('icon-plus');
	}
	else
	{
	    element.parents('.template-field').find('.content').show();
	    element.addClass('show');
	    element.find('i').removeClass('icon-plus').addClass('icon-minus');
	}
    }
    $(document).ready(function() {
	$('#current_fields .close a').click(close_button_handler);
	$('#add_custom_field .btn a').click(function() {
	    var max_id = 0;
	    $('#current_fields .template-field.new').each(function(i, e){
		var ele = $(e);
		var id = ele.attr('data-id') * 1;
		if (max_id < id)
		    max_id = id;
	    });
	    
	    max_id++;
	    var type = $(this).attr('data-type');
	    var new_field = $('#field_templates .template-' + type).clone();
	    new_field.addClass('new');
	    new_field.attr('data-id', max_id);
	    new_field.find('input[type=hidden]').attr('name', 'fields_new[' + max_id + '][type]');
	    new_field.find('.custom.title').attr('name', 'fields_new[' + max_id + '][title]');
	    new_field.find('.custom.description').attr('name', 'fields_new[' + max_id + '][description]');
	    new_field.find('.custom.domain').attr('name', 'fields_new[' + max_id + '][domain]');
	    new_field.find('.close a').click(close_button_handler);
	    new_field.appendTo('#current_fields');
	});
    });
})();
