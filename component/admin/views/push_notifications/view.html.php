<?php
/**
 * @package     Redcore.Admin
 * @subpackage  Views
 *
 * @copyright   Copyright (C) 2008 - 2015 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die;

/**
 * Push Notifications View
 *
 * @package     Redcore.Admin
 * @subpackage  Views
 * @since       1.0
 */
class RedcoreViewPush_Notifications extends RedcoreHelpersView
{
	/**
	 * @var  array
	 */
	public $items;

	/**
	 * @var  object
	 */
	public $state;

	/**
	 * @var  JPagination
	 */
	public $pagination;

	/**
	 * @var  JForm
	 */
	public $filterForm;

	/**
	 * @var array
	 */
	public $activeFilters;

	/**
	 * @var array
	 */
	public $stoolsOptions = array();

	/**
	 * @var  object
	 */
	public $translationTable;

	/**
	 * @var  string
	 */
	public $contentElement;

	/**
	 * Display method
	 *
	 * @param   string  $tpl  The template name
	 *
	 * @return  void
	 */
	public function display($tpl = null)
	{
		$model = $this->getModel();
		$app = JFactory::getApplication();

		$this->activeFilters = $model->getActiveFilters();
		$this->state = $model->getState();
		$this->filterForm = $model->getForm();
		$this->pagination = $model->getPagination();

		parent::display($tpl);
	}

	/**
	 * Get the view title.
	 *
	 * @return  string  The view title.
	 */
	public function getTitle()
	{
		return JText::_('COM_REDCORE_PUSH_NOTIFICATIONS');
	}

	/**
	 * Get the toolbar to render.
	 *
	 * @return  RToolbar
	 */
	public function getToolbar()
	{
		$firstGroup = new RToolbarButtonGroup;
		$secondGroup = new RToolbarButtonGroup;

		if (!empty($this->contentElement))
		{
			$delete = RToolbarBuilder::createDeleteButton('translations.delete');
			$firstGroup->addButton($delete);

			// Manage
			$manage = RToolbarBuilder::createStandardButton(
				'translations.manageContentElement',
				JText::_('COM_REDCORE_TRANSLATIONS_MANAGE_CONTENT_ELEMENTS'),
				'btn btn-primary',
				'icon-globe',
				false
			);
			$secondGroup->addButton($manage);
		}

		$toolbar = new RToolbar;
		$toolbar->addGroup($firstGroup)
			->addGroup($secondGroup);

		return $toolbar;
	}
}
