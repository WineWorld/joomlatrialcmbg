<?php 

$generalSettings = self::getSettings("general");
$settingsOutput = new UniteSettingsRevProductRev();
$settingsOutput->init($generalSettings);

?>


<div id="dialog_general_settings" title="<?php _e("General Settings",REVSLIDER_TEXTDOMAIN)?>" style="display:none;">
	
	<div class="settings_wrapper unite_settings_wide">
			<form name="form_general_settings" id="form_general_settings">
					<script type="text/javascript">
						g_settingsObj['form_general_settings'] = {}					
					</script>
					<table class="form-table">				
						<tbody>
							<tr id="role_row" valign="top">
								<th scope="row">
									View&nbsp;Plugin&nbsp;Permission:
								</th>
								<td>
									<select id="role" name="role">
										<option value="admin" selected="selected">To Admin</option>
										<option value="editor">To Editor, Admin</option>
										<option value="author">Author, Editor, Admin</option>
									</select>
								
									<div class="description_container">
										<span class="description"><?php _e("The role of user that can view and edit the plugin",REVSLIDER_TEXTDOMAIN)?></span>					
									</div>
								</td>
							</tr>								
							<tr id="includes_globally_row" valign="top">
								<th scope="row">
									Include&nbsp;RevSlider&nbsp;libraries&nbsp;globally:
								</th>
								<td>
									<span id="includes_globally_wrapper" class="radio_settings_wrapper">
									<div class="radio_inner_wrapper">
										<input type="radio" id="includes_globally_1" value="on" name="includes_globally" checked="checked">
										<label for="includes_globally_1" style="cursor:pointer;">On</label>
									</div>
						
									<div class="radio_inner_wrapper">
										<input type="radio" id="includes_globally_2" value="off" name="includes_globally">
										<label for="includes_globally_2" style="cursor:pointer;">Off</label>
									</div>					
									</span>
						
									<div class="description_container">
										<span class="description"><?php _e("ON - Add CSS and JS Files to all pages. </br>Off - CSS and JS Files will be only loaded on Pages where any rev_slider shortcode exists.",REVSLIDER_TEXTDOMAIN)?></span>					
									</div>
								</td>
							</tr>								
							<tr id="pages_for_includes_row" valign="top">
								<th scope="row">
									Pages&nbsp;to&nbsp;include&nbsp;RevSlider&nbsp;libraries:
								</th>
								<td>
									<input type="text" class="regular-text" id="pages_for_includes" name="pages_for_includes" value="">			
									<div class="description_container">
										<span class="description"><?php _e("Specify the page id's that the front end includes will be included in. Example: 2,3,5 also: homepage,3,4",REVSLIDER_TEXTDOMAIN)?></span>
					
									</div>
								</td>
							</tr>								
							<tr id="js_to_footer_row" valign="top">
								<th scope="row">
									Put&nbsp;JS&nbsp;Includes&nbsp;To&nbsp;Footer:
								</th>
								<td>
									<span id="js_to_footer_wrapper" class="radio_settings_wrapper">
										<div class="radio_inner_wrapper">
											<input type="radio" id="js_to_footer_1" value="on" name="js_to_footer">
											<label for="js_to_footer_1" style="cursor:pointer;">On</label>
										</div>
						
										<div class="radio_inner_wrapper">
											<input type="radio" id="js_to_footer_2" value="off" name="js_to_footer" checked="checked">
											<label for="js_to_footer_2" style="cursor:pointer;">Off</label>
										</div>					
									</span>					
									<div class="description_container">
										<span class="description"><?php _e("Putting the js to footer (instead of the head) is good for fixing some javascript conflicts.",REVSLIDER_TEXTDOMAIN)?></span>				
									</div>
								</td>
							</tr>								
					</tbody>
				</table>				
			</form>
	</div>
<br>

<a id="button_save_general_settings" class="button-primary" original-title="">Update</a>
<span id="loader_general_settings" class="loader_round mleft_10" style="display: none;"></span>

<!-- 
&nbsp;
<a class="button-primary">Close</a>
-->

</div>
	 
</div>
