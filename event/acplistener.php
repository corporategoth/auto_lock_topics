<?php

/**
*
* Auto Ban extension - ACP Listener
*
* @copyright (c) 2014 PreZ <http://www.goth.net>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace prez\auto_lock_topics\event;

/**
* Event listener
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class acplistener implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
			'core.acp_manage_forums_request_data'		=> 'add_request_options',
			'core.acp_manage_forums_initialize_data'	=> 'add_initial_data',
			'core.acp_manage_forums_display_form'		=> 'add_display_form_fields',
			'core.acp_manage_forums_update_data_before'	=> 'update_forums_data',
		);
	}

	/**
	* Constructor
	* NOTE: The parameters of this method must match in order and type with
	* the dependencies defined in the services.yml file for this service.
	*
	* @param \phpbb\controller\helper		$helper				Controller helper object
	* @param \phpbb\user		$user		User object
	*/
	public function __construct(\phpbb\controller\helper $helper, \phpbb\user $user)
	{
		$this->helper = $helper;
		$this->user = $user;
	}

	public function add_request_options($event)
	{
		$forum_data = $event['forum_data'];
		$forum_data += array(
			'enable_auto_lock'	=> request_var('enable_auto_lock', false),
			'auto_lock_days'	=> request_var('auto_lock_days', 7),
			'auto_lock_viewed'	=> request_var('auto_lock_viewed', 7),
			'auto_lock_freq'	=> request_var('auto_lock_freq', 1),
			'auto_lock_old_polls'	=> request_var('auto_lock_old_polls', false),
			'auto_lock_announce'	=> request_var('auto_lock_announce', false),
			'auto_lock_sticky'	=> request_var('auto_lock_sticky', false),
		);
		$event['forum_data'] = $forum_data;
	}

	public function add_initial_data($event) {
		switch ($event['action']) {
		case 'add':
		case 'edit':
			$forum_data = $event['forum_data'];

			if ($event['update']) {
				$forum_data['auto_lock_flags'] = 0;
				$forum_data['auto_lock_flags'] += (request_var('auto_lock_old_polls', false)) ? FORUM_FLAG_PRUNE_POLL : 0;
				$forum_data['auto_lock_flags'] += (request_var('auto_lock_announce', false)) ? FORUM_FLAG_PRUNE_ANNOUNCE : 0;
				$forum_data['auto_lock_flags'] += (request_var('auto_lock_sticky', false)) ? FORUM_FLAG_PRUNE_STICKY : 0;
			}

			if ($event['action'] != 'edit') {
				if (!$event['update']) {
					$forum_data += array(
						'enable_auto_lock'	=> false,
						'auto_lock_days'	=> 7,
						'auto_lock_viewed'	=> 7,
						'auto_lock_freq'	=> 1,
						'auto_lock_flags'	=> 0,
					);
				}
			}

			$event['forum_data'] = $forum_data;
		}
	}

	public function add_display_form_fields($event) {
		$template_data = $event['template_data'];

		$template_data += array(
			'AUTO_LOCK_FREQ'		=> $event['forum_data']['auto_lock_freq'],
			'AUTO_LOCK_DAYS'		=> $event['forum_data']['auto_lock_days'],
			'AUTO_LOCK_VIEWED'		=> $event['forum_data']['auto_lock_viewed'],
			'S_AUTO_LOCK_ENABLE'		=> $event['forum_data']['enable_auto_lock'] ? true : false,
			'S_AUTO_LOCK_OLD_POLLS'         => ($event['forum_data']['auto_lock_flags'] & FORUM_FLAG_PRUNE_POLL) ? true : false,
			'S_AUTO_LOCK_ANNOUNCE'          => ($event['forum_data']['auto_lock_flags'] & FORUM_FLAG_PRUNE_ANNOUNCE) ? true : false,
			'S_AUTO_LOCK_STICKY'            => ($event['forum_data']['auto_lock_flags'] & FORUM_FLAG_PRUNE_STICKY) ? true : false,
		);

		$event['template_data'] = $template_data;
	}

	public function update_forums_data($event) {
		$forum_data = $event['forum_data'];
		$forum_data_sql = $event['forum_data_sql'];

		$forum_data['auto_lock_flags'] = 0;
                $forum_data['auto_lock_flags'] += ($forum_data['auto_lock_old_polls']) ? FORUM_FLAG_PRUNE_POLL : 0;
                $forum_data['auto_lock_flags'] += ($forum_data['auto_lock_announce']) ? FORUM_FLAG_PRUNE_ANNOUNCE : 0;
                $forum_data['auto_lock_flags'] += ($forum_data['auto_lock_sticky']) ? FORUM_FLAG_PRUNE_STICKY : 0;

		$forum_data_sql['auto_lock_flags'] = $forum_data['auto_lock_flags'];
		unset($forum_data_sql['auto_lock_old_polls']);
		unset($forum_data_sql['auto_lock_announce']);
		unset($forum_data_sql['auto_lock_sticky']);

		$event['forum_data'] = $forum_data;
		$event['forum_data_sql'] = $forum_data_sql;
	}
}
