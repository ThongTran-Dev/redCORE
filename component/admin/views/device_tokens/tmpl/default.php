<?php
/**
 * @package     Redcore.Admin
 * @subpackage  Templates
 *
 * @copyright   Copyright (C) 2008 - 2015 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */
defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('rdropdown.init');
JHtml::_('rbootstrap.tooltip');
JHtml::_('rjquery.chosen', 'select');

$action = JRoute::_('index.php?option=com_redcore&view=device_tokens');
$listOrder = $this->state->get('list.ordering');
$listDirn = $this->state->get('list.direction');
?>
<form action="<?php echo $action; ?>" name="adminForm" class="adminForm" id="adminForm" method="post">
	<?php
	echo RLayoutHelper::render(
		'searchtools.default',
		array(
			'view' => $this,
			'options' => array(
				'filtersHidden' => false,
				'searchField' => 'search_device_tokens',
				'searchFieldSelector' => '#filter_search_device_tokens',
				'limitFieldSelector' => '#list_device_tokens_limit',
				'activeOrder' => $listOrder,
				'activeDirection' => $listDirn
			)
		)
	);
	?>
	<hr/>
	<div class="row">
		<?php if (empty($this->items)): ?>
			<div class="alert alert-info">
				<h3><?php echo JText::_('COM_REDCORE_NOTHING_TO_DISPLAY') ?></h3>
			</div>
		<?php else: ?>
			<table class="table table-striped table-hover" id="deviceTokenLists">
				<thead>
					<tr>
						<th class="hidden-xs">
							<input type="checkbox" name="checkall-toggle" value=""
							       title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)"/>
						</th>
						<th class="nowrap center" width="1%">
							<?php echo JHtml::_('rsearchtools.sort', 'JSTATUS', 'd.state', $listDirn, $listOrder); ?>
						</th>
						<th class="nowrap">
							<?php echo JHtml::_('rsearchtools.sort', JText::_('COM_REDCORE_DEVICE_TOKENS_USER_LABEL'), 'd.user_name', $listDirn, $listOrder); ?>
						</th>
						<th class="nowrap">
							<?php echo JHtml::_('rsearchtools.sort', JText::_('COM_REDCORE_DEVICE_TOKENS_DEVICE_LABEL'), 'd.device', $listDirn, $listOrder); ?>
						</th>
						<th class="nowrap">
							<?php echo JHtml::_('rsearchtools.sort', JText::_('COM_REDCORE_DEVICE_TOKENS_TOKEN_LABEL'), 'd.token', $listDirn, $listOrder); ?>
						</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($this->items as $i => $item): ?>
					<td>
						<?php echo JHtml::_('grid.id', $i, $item->id) ?>
					</td>
					<td>
						<?php echo JHtml::_('rgrid.published', $item->state, $i, 'device_tokens.', $canChange = true, 'cb') ?>
					</td>
					<td>
						<?php echo $item->user_name ?>
					</td>
					<td>
						<?php echo JText::_('COM_REDCORE_DEVICE_TOKENS_DEVICE_OPTION_' . strtoupper($item->device)) ?>
					</td>
					<td class="nowrap">
						<?php echo $item->token ?>
					</td>
				<?php endforeach; ?>
				</tbody>
			</table>
			<?php echo $this->pagination->getListFooter(); ?>
		<?php endif; ?>
	</div>

	<div>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="boxchecked" value="0">
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
