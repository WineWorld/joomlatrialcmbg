<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');

if (isset($this->error)) : ?>
	<div class="contact-error">
		<?php echo $this->error; ?>
	</div>
<?php endif; ?>

<div class="stability-form">
    <form id="contact-form" action="<?php echo JRoute::_('index.php'); ?>" method="post" id="contact-form">

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo $this->form->getLabel('contact_name'); ?>
                    <?php echo $this->form->getInput('contact_name'); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo $this->form->getLabel('contact_email'); ?>
                    <?php echo $this->form->getInput('contact_email'); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo $this->form->getLabel('contact_subject'); ?>
                    <?php echo $this->form->getInput('contact_subject'); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo $this->form->getLabel('contact_message'); ?>
                    <?php echo $this->form->getInput('contact_message'); ?>
                </div>
            </div>
        </div>
        <?php if ($this->params->get('show_email_copy')) { ?>
		<div class="row">
            <div class="col-md-12">
                <?php echo $this->form->getLabel('contact_email_copy'); ?>
                <?php echo $this->form->getInput('contact_email_copy'); ?>
			</div>
        </div>
        <div class="vg-spacing"></div>
		<?php } ?>
        <?php //Dynamically load any additional fields from plugins. ?>
		<?php foreach ($this->form->getFieldsets() as $fieldset) : ?>
			<?php if ($fieldset->name != 'contact'):?>
				<?php $fields = $this->form->getFieldset($fieldset->name);?>
				<?php foreach ($fields as $field) : ?>
					<div class="row">
                        <div class="col-md-12">
                            <?php if ($field->hidden) : ?>
                                <?php echo $field->input;?>
                            <?php else:?>
                                <?php echo $field->label; ?>
                                <?php if (!$field->required && $field->type != "Spacer") : ?>
                                    <span class="optional"><?php echo JText::_('COM_CONTACT_OPTIONAL');?></span>
                                <?php endif; ?>
                                <?php echo $field->input;?>
                            <?php endif;?>
                        </div>
                    </div>
				<?php endforeach;?>
			<?php endif ?>
		<?php endforeach;?>
            
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-primary validate" type="submit"><?php echo JText::_('COM_CONTACT_CONTACT_SEND'); ?></button>
            </div>
        </div>
        <input type="hidden" name="option" value="com_contact" />
		<input type="hidden" name="task" value="contact.submit" />
        <input type="hidden" name="return" value="<?php echo $this->return_page;?>" />
		<input type="hidden" name="id" value="<?php echo $this->contact->slug; ?>" />
		<?php echo JHtml::_('form.token'); ?>
     </form>
</div>

<script>
jQuery(document).ready(function($){
	jQuery('#jform_contact_name').addClass('form-control');
	jQuery('#jform_contact_email').addClass('form-control');
	jQuery('#jform_contact_emailmsg').addClass('form-control');
	jQuery('#jform_contact_message').addClass('form-control');
});
</script>