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
 * Device token table.
 *
 * @package     Redcore.Backend
 * @subpackage  Tables
 * @since       1.5
 */
class RedcoreTableDevice_Token extends RTable
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
	 * @var int
	 */
	public $state;

	/**
	 * @var  string
	 */
	public $created_date = '0000-00-00 00:00:00';

	/**
	 * @var  integer
	 */
	public $created_by = null;

	/**
	 * @var  string
	 */
	public $modified_date = '0000-00-00 00:00:00';

	/**
	 * @var  integer
	 */
	public $modified_by = null;

	/**
	 * @var  string
	 */
	public $checked_out_time = '0000-00-00 00:00:00';

	/**
	 * @var  integer
	 */
	public $checked_out = null;

	/**
	 * Constructor
	 *
	 * @param   JDatabase  &$db  A database connector object
	 *
	 * @throws  UnexpectedValueException
	 */
	public function __construct(&$db)
	{
		$this->_tableName = 'redcore_device_tokens';
		$this->_tbl_key = 'id';

		parent::__construct($db);
	}
}
