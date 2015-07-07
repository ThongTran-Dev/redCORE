<?php
/**
 * @package     Redcore.Backend
 * @subpackage  Tables
 *
 * @copyright   Copyright (C) 2008 - 2015 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die;

/**
 * Push notification table.
 *
 * @package     Redcore.Backend
 * @subpackage  Tables
 * @since       1.5
 */
class RedcoreTablePush_Notification extends RTable
{
	/**
	 * @var  int
	 */
	public $id;

	/**
	 * @var  int
	 */
	public $user_id;

	/**
	 * @var  string
	 */
	public $device;

	/**
	 * @var  string
	 */
	public $token;

	/**
	 * Constructor
	 *
	 * @param   JDatabase  &$db  A database connector object
	 *
	 * @throws  UnexpectedValueException
	 */
	public function __construct(&$db)
	{
		$this->_tableName = 'redcore_push_notification';
		$this->_tbl_key = 'id';

		parent::__construct($db);
	}
}
