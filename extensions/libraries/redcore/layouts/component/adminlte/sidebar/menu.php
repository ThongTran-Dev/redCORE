<?php
/**
 * @package     Aesir.Backend
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2008 - 2015 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;

$input = JFactory::getApplication()->input;

// Run plugin event
JPluginHelper::importPlugin('reditem_quickicon');
$dispatcher = RFactory::getDispatcher();
$icons = $dispatcher->trigger('getSidebarIcons');
$stats = ReditemHelperSystem::getStats();

$option = $input->get('option', '');
$component = 'com_reditem';
$activeView = $input->get('view', 'dashboard');
?>
<ul class="sidebar-menu">
	<?php foreach ($icons[0] as $group) : ?>
		<?php if (empty($group)) continue ?>

		<li class="header"><?php echo strtoupper($group['header']) ?></li>

		<?php foreach ($group['icons'] as $icon): ?>
			<?php $class = ($activeView === $icon['view']) ? 'active' : '' ?>
			<?php $badge = isset($icon['badge']) ? $icon['badge'] : 'badge-default' ?>

			<li class="<?php echo $class ?>">
				<a href="<?php echo $icon['link'] ?>">
					<i class="<?php echo $icon['icon'] ?>"></i>
					<span><?php echo $icon['text'] ?></span>

					<?php if (!empty($stats[$icon['view']])) : ?>
						<span class="badge <?php echo $badge ?> pull-right">
							<?php echo $stats{$icon['view']} ?>
						</span>
					<?php endif ?>
				</a>
			</li>
		<?php endforeach; ?>
	<?php endforeach ?>
</ul>
