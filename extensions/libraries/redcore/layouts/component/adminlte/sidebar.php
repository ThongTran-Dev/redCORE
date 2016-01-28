<?php
/**
 * @package     RedCORE.AdminLTE.Backend
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2008 - 2015 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;

$option            = JFactory::getApplication()->input->getString('component', '');
$view              = RInflector::pluralize(JFactory::getApplication()->input->getString('view', ''));
$return            = JFactory::getApplication()->input->getString('return', '');
$contentElement    = JFactory::getApplication()->input->getString('contentelement', '');
$components        = RedcoreHelpersView::getExtensionsRedcore();
$translationTables = RTranslationHelper::getInstalledTranslationTables();

if (empty($return))
{
	$return = base64_encode('index.php?option=com_redcore&view=dashboard');
}
?>
<section class="sidebar">
	<ul class="sidebar-menu">
		<li>
			<a href="<?php echo JRoute::_('index.php?option=com_redcore&view=dashboard') ?>">
				<i class="fa fa-dashboard"></i><span><?php echo JText::_('COM_REDCORE_DASHBOARD') ?></span>
			</a>
		</li>
		<li class="treeview<?php echo $view === 'config' ? ' active' : '';?>">
			<a href="#">
				<i class="fa fa-cogs"></i>
				<span><?php echo JText::_('COM_REDCORE_CONFIGURATION') ?></span>
				<label class="label bg-red"><?php echo count($components) ?></label>
				<?php if (count($components) > 0): ?>
				<i class="fa fa-angle-left pull-right"></i>
				<?php endif; ?>
			</a>
			<ul class="treeview-menu">
				<?php foreach ($components as $component) : ?>
					<li class="<?php echo $option == $component->option ? 'active' : ''; ?>">
						<a href="<?php echo JRoute::_('index.php?option=com_redcore&view=config&layout=edit&component=' . $component->option . '&return=' . $return) ?>">
							<i class="fa fa-cogs"></i><span><?php echo JText::_($component->xml->name); ?></span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</li>
		<li class="treeview<?php echo $view === 'translations' ? ' active' : '';?>">
			<a href="#">
				<i class="fa fa-cogs"></i>
				<span><?php echo JText::_('COM_REDCORE_TRANSLATIONS') ?></span>
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<?php foreach ($translationTables as $translationTable) : ?>
					<li class="<?php echo $contentElement == str_replace('#__', '', $translationTable->table) ? 'active' : ''; ?>">
						<a href="<?php echo JRoute::_(
							'index.php?option=com_redcore&view=translations&component=' . $translationTable->option . '&contentelement='
							. str_replace('#__', '', $translationTable->table)
							. '&return=' . $return
						); ?>">
							<span><?php echo $translationTable->name; ?></span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</li>
		<li class="<?php echo $view === 'webservices' ? 'active' : '';?>">
			<a href="<?php echo JRoute::_('index.php?option=com_redcore&view=webservices') ?>">
				<i class="fa fa-globe"></i>
				<span><?php echo JText::_('COM_REDCORE_WEBSERVICES') ?></span>
			</a>
		</li>
		<li class="<?php echo $view === 'oauth_clients' ? 'active' : '';?>">
			<a href="<?php echo JRoute::_('index.php?option=com_redcore&view=oauth_clients') ?>">
				<i class="fa fa-globe"></i>
				<span><?php echo JText::_('COM_REDCORE_OAUTH_CLIENTS') ?></span>
			</a>
		</li>
		<li class="treeview<?php echo in_array($view, array('payments', 'payment_configurations', 'payment_dashboards', 'payment_logs')) ? ' active' : '';?>">
			<a href="#">
				<i class="fa fa-money"></i>
				<span><?php echo JText::_('COM_REDCORE_PAYMENTS') ?></span>
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li>
					<a href="<?php echo JRoute::_('index.php?option=com_redcore&view=payment_dashboard') ?>">
						<i class="fa fa-dashboard"></i>
						<?php echo JText::_('COM_REDCORE_PAYMENT_DASHBOARD') ?>
					</a>
				</li>
				<li>
					<a href="<?php echo JRoute::_('index.php?option=com_redcore&view=payment_configurations') ?>">
						<i class="fa fa-cogs"></i>
						<?php echo JText::_('COM_REDCORE_PAYMENT_CONFIGURATION_LIST_TITLE') ?>
					</a>
				</li>
				<li>
					<a href="<?php echo JRoute::_('index.php?option=com_redcore&view=payments') ?>">
						<i class="fa fa-money"></i>
						<?php echo JText::_('COM_REDCORE_PAYMENTS') ?>
					</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="http://redcomponent-com.github.io/redCORE/" target="_blank">
				<i class="fa fa-book"></i>
				<?php echo JText::_('COM_REDCORE_DOCUMENTATION_LINK_TITLE') ?>
			</a>
		</li>
	</ul>
</section>
