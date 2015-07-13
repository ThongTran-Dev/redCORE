<?php
/**
 * @package     Redcore.Backend
 * @subpackage  Models
 *
 * @copyright   Copyright (C) 2008 - 2015 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die;

/**
 * Device Tokens Model
 *
 * @package     Redcore.Backend
 * @subpackage  Models
 * @since       1.6.2
 */
class RedcoreModelDevice_Tokens extends RModelList
{
	/**
	 * Name of the filter form to load
	 *
	 * @var  string
	 */
	protected $filterFormName = 'filter_device_tokens';

	/**
	 * Constructor
	 *
	 * @param   array  $config  Configuration array
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'd.id',
				'state', 'd.state',
				'device', 'd.device',
				'token', 'd.token',
				'user_name'
			);
		}

		parent::__construct($config);
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return  JDatabaseQuery
	 */
	protected function getListQuery()
	{
		$db = $this->getDbo();

		$query = $db->getQuery(true)
			->select($this->getState('list.select', 'd.*, ' . $db->qn('u.name', 'user_name')))
			->from($db->qn('#__redcore_device_tokens', 'd'))
			->leftJoin($db->qn('#__users', 'u') . ' ON ' . $db->qn('d.user_id') . ' = ' . $db->qn('u.id'));

		// Filter search
		$search = $this->getState('filter.search_device_tokens');

		if (!empty($search))
		{
			$search = $db->quote('%' . $db->escape($search, true) . '%');
			$query->where('(' . $db->qn('d.token') . ' LIKE ' . $search . ')');
		}

		// Filter by Device Type
		$type = $this->getState('filter.filter_type');

		if (!empty($type))
		{
			$query->where($db->qn('d.device') . ' = ' . $db->quote($type));
		}

		// Ordering
		$orderList = $this->getState('list.ordering');
		$directionList = $this->getState('list.direction');

		$order = !empty($orderList) ? $orderList : 'd.id';
		$direction = !empty($directionList) ? $directionList : 'ASC';
		$query->order($db->escape($order) . ' ' . $db->escape($direction));

		echo $query->dump();

		return $query;
	}
}
