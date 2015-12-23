/**
 * @version		$Id$
 * @author		NooTheme
 * @package		Joomla.Site
 * @subpackage	mod_noo_gallery
 * @copyright	Copyright (C) 2013 NooTheme. All rights reserved.
 * @license		License GNU General Public License version 2 or later; see LICENSE.txt, see LICENSE.php
 */

/**
 * Function for hide options.
 * 
 * @param   string  sub_fields  The list of fields to Hide.
 */
function jux_HideOptions(sub_fields) {
	if((/^\s*$/).test(sub_fields)) {
		return;
	}

	fields = sub_fields.split(',');
	for(var i = 0; i < fields.length; i ++){
		if($('jform_params_'+ fields[i])){
			var control_DIV	= $('jform_params_'+ fields[i]).getParent('div').getParent('div.control-group');
			if(control_DIV && !control_DIV.hasClass('hide')) {
				control_DIV.addClass('hide');
			}
		}
	}
}

/**
 * Function for show options.
 * 
 * @param   string  sub_fields  The list of fields to Show.
 */
function jux_ShowOptions(sub_fields) {
	if((/^\s*$/).test(sub_fields)) {
		return;
	}

	fields = sub_fields.split(',');
	
	for(var i = 0; i < fields.length; i ++){
		if($('jform_params_'+ fields[i])){
			var control_DIV	= $('jform_params_'+ fields[i]).getParent('div').getParent('div.control-group');
			if(control_DIV && control_DIV.hasClass('hide')) {
				control_DIV.removeClass('hide');
			}
		}
	}	
}

/**
 * Function for setup MoreSetting button when start up.
 * 
 * @param	sub_fields			string	The list of active sub fields to Show.
 * @param	control_field_name	string	The name of controlling field.
 * @param	on_label			string	Label for On Button.
 * @param	off_label			string	Label for Off Button.
 */
function jux_OnOffButtonStart(sub_fields, control_field_name) {
	var control_field	= $('jform_params_' + control_field_name);

	if(control_field.value != "0"){
		jux_ShowOptions(sub_fields);
	} else {
		jux_HideOptions(sub_fields);
	}
}

/**
 * Class for Set up Accordion inside a panel of Joomla module's option.
 */
JUX_Accordion_Options = new Class ( {
	toggler_class: 'jux_toggler',
	element_class: 'jux_element',
	pane_id_list: [],

	initialize: function(toggler_class, element_class){
        this.toggler_class = toggler_class;
        this.element_class = element_class;
    },

	addPane: function(pane_id) {
		if(this.pane_id_list.length > 0) {
			last_pane_id = this.pane_id_list.getLast();
			this.addAccordionElement(last_pane_id, pane_id);
		}
		
		this.pane_id_list.push(pane_id);
	},
	
	addAccordionElement: function(start_pane_id, end_pane_id) {
		// Get this li
		var start_field_li	= $(start_pane_id).getParent('div').getParent('div.control-group');
		var end_field_li	= $(end_pane_id).getParent('div').getParent('div.control-group');
	
		// Inject start DIV before this li
		var paneDIV			= new Element('div');
		paneDIV.set('class', 'jux_option_element ' + this.element_class);

		
		// Temp element for loop, we'll need two
		var temp_li			= start_field_li.getNext('div.control-group');
		var temp_li_2		= temp_li;

		// Loop through li
		while (temp_li != null && !temp_li.match(end_field_li)) {
			temp_li_2	= temp_li.getNext('div.control-group');
			paneDIV.wraps(temp_li);
			temp_li		= temp_li_2;
		}
	},
	
	start: function(){
		this.correctTogglerClass();
		new Fx.Accordion($$('.' + this.toggler_class),$$('.' + this.element_class), {
			opacity: 0,
			onActive: function(toggler, section) {
				toggler.removeClass('jux_option_toggler-close');
				toggler.addClass('jux_option_toggler');
				
				//section.addClass('jux_option_element-active');
			},
			onBackground: function(toggler, section) {
				//section.removeClass('jux_option_element-active');

				toggler.removeClass('jux_option_toggler');
				toggler.addClass('jux_option_toggler-close');
			}
		});
	},
	
	correctTogglerClass: function() {
		var togglers = document.getElements('.'+this.toggler_class);
		togglers.each(function(toggler){
			toggler.getParent('div').removeClass('control-label');
			toggler.getParent('div').addClass('jux_toggler-bound');
		});
	}
	
});
