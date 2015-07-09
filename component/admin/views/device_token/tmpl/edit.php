<?php
/**
 * @package     Redcore.Admin
 * @subpackage  Templates
 *
 * @copyright   Copyright (C) 2008 - 2015 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;

$action = JRoute::_('index.php?option=com_redcore&view=device_token');

// HTML helpers
JHtml::_('behavior.keepalive');
JHtml::_('rbootstrap.tooltip');
JHtml::_('rjquery.chosen', 'select');
?>
<form action="<?php echo $action; ?>" method="post" name="adminForm" id="adminForm"
      class="form-validate form-horizontal">
	<div class="container-fluid">
		<div id="main-params">
			<div class="form-group">
				<div class="control-label">
					<?php echo $this->form->getLabel('device'); ?>
				</div>
				<div class="controls">
					<?php echo $this->form->getInput('device'); ?>
				</div>
			</div>
			<div class="form-group">
				<div class="control-label">
					<?php echo $this->form->getLabel('token'); ?>
				</div>
				<div class="controls">
					<?php echo $this->form->getInput('token'); ?>
				</div>
			</div>
			<div class="form-group">
				<div class="control-label">
					<?php echo $this->form->getLabel('user_id'); ?>
				</div>
				<div class="controls">
					<?php echo $this->form->getInput('user_id'); ?>
				</div>
			</div>
			<div class="form-group">
				<div class="control-label">
					<?php echo $this->form->getLabel('state'); ?>
				</div>
				<div class="controls">
					<?php echo $this->form->getInput('state'); ?>
				</div>
			</div>
		</div>
	</div>

	<!-- hidden fields -->
	<input type="hidden" name="option" value="com_redcore">
	<input type="hidden" name="id" value="<?php echo $this->item->id; ?>">
	<input type="hidden" name="task" value="">
	<?php echo JHTML::_('form.token'); ?>
</form>
