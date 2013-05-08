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
	    element.parents('.template-field').find('.content').hide(200);
	    element.removeClass('show');
	    element.removeClass('icon-up-open-big').addClass('icon-down-open-big');
	}
	else
	{
	    element.parents('.template-field').find('.content').show(200);
	    element.addClass('show');
	    element.removeClass('icon-down-open-big').addClass('icon-up-open-big');
	}
    }

    function title_changed_handler(ele)
    {
	var element = $(ele.currentTarget);
	var target = element.parents('.template-field').find('.header .title');
	if (target)
	    target.html(element.val());
    }

    function remove_button_click_handler(ele)
    {
	var element = $(ele.currentTarget);

	function remove_confirmed() {
	    element.parents('.template-field').remove();
	    $('#remove_item_message').message('hide');
	}

	$('#remove_item_message').message(
		'show',
		{
		    successHandler: remove_confirmed
		}
	);


    }

    function add_field_button_click_handler(ele)
    {

	var max_id = 0;
	$('#current_fields .template-field').each(function(i, e) {
	    var element = $(e);
	    var id = element.attr('data-id') * 1;
	    if (max_id < id)
		max_id = id;
	});

	max_id++;
	var type = $(ele.currentTarget).attr('data-type');
	var new_field = $('#field_templates .template-' + type).clone();
	new_field.addClass('new');
	new_field.attr('data-id', max_id);
	new_field.find('input[type=hidden]').attr('name', 'fields[item_' + max_id + '][type]');
	new_field.find('.custom.title')
		.attr('id', 'fields[item_' + max_id + '][title]')
		.attr('name', 'fields[item_' + max_id + '][title]');
	new_field.find('.custom.description')
		.attr('id', 'fields[item_' + max_id + '][description]')
		.attr('name', 'fields[item_' + max_id + '][description]');
	new_field.find('.custom.domain')
		.prop('id', 'fields[item_' + max_id + '][domain]')
		.attr('name', 'fields[item_' + max_id + '][domain]');
	new_field.find('.close i').click(close_button_handler);
	new_field.find('input.custom.title').keyup(title_changed_handler);
	new_field.find('.remove').click(remove_button_click_handler);
	new_field.appendTo('#current_fields');
	$('#current_fields').sortable('refresh');
    }

    $(document).ready(function() {
	$('#current_fields .close i').click(close_button_handler);
	$('#current_fields input.custom.title').keyup(title_changed_handler);
	$('#current_fields .remove').click(remove_button_click_handler);

	$('#add_custom_field .btn a').click(add_field_button_click_handler);
	$('#current_fields .template-field .content').hide();
	$('#current_fields').sortable({
	    placeholder: "row ui-state-highlight"
	});
    });
})();
