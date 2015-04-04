<?php
/**
*
* @package migration
* @copyright (c) 2012 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License v2
*
*/

namespace prez\auto_lock_topics\migrations;

class release_0_1 extends \phpbb\db\migration\migration
{
	public function update_data()
	{
		return array(
			array('config.add', array('auto_lock_topics_version', '0.1')),
		);
	}

	//lets create the needed table
	public function update_schema()
	{
		return array(
			'add_columns'    => array(
				$this->table_prefix . 'forums'		=> array(
					'enable_auto_lock'	=> array('BOOL', 0),
					'auto_lock_flags'	=> array('UINT:4', 0),
					'auto_lock_next'	=> array('INT:11', 0),
					'auto_lock_days'	=> array('UINT:8', 90),
					'auto_lock_viewed'	=> array('UINT:8', 0),
					'auto_lock_freq'	=> array('UINT:8', 7),
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_columns'		=> array(
				$this->table_prefix . 'forums'		=> array(
					'enable_auto_lock',
					'auto_lock_flags',
					'auto_lock_next',
					'auto_lock_days',
					'auto_lock_viewed',
					'auto_lock_freq',
				),
			),
		);
	}
}
