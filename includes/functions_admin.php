<?php
/**
*
* This file is modified from part of the phpBB Forum Software package.
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
* For full copyright and license information, please see
* the docs/CREDITS.txt file.
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* Lock Topics function
*/
function lock_topics($forum_id, $auto_lock_mode, $auto_lock_date, $auto_lock_flags = 0)
{
	global $db, $phpbb_dispatcher;

	if (!is_array($forum_id))
	{
		$forum_id = array($forum_id);
	}

	if (!sizeof($forum_id))
	{
		return;
	}

	$sql_and = '';

	if (!($auto_lock_flags & FORUM_FLAG_PRUNE_ANNOUNCE))
	{
		$sql_and .= ' AND topic_type <> ' . POST_ANNOUNCE;
		$sql_and .= ' AND topic_type <> ' . POST_GLOBAL;
	}

	if (!($auto_lock_flags & FORUM_FLAG_PRUNE_STICKY))
	{
		$sql_and .= ' AND topic_type <> ' . POST_STICKY;
	}

	if ($auto_lock_mode == 'posted')
	{
		$sql_and .= " AND topic_last_post_time < $auto_lock_date";
	}

	if ($auto_lock_mode == 'viewed')
	{
		$sql_and .= " AND topic_last_view_time < $auto_lock_date";
	}

	$sql = 'UPDATE ' . TOPICS_TABLE . ' SET topic_status = ' . ITEM_LOCKED .
		' WHERE ' . $db->sql_in_set('forum_id', $forum_id) . 
		' AND topic_status = ' . ITEM_UNLOCKED . " AND poll_start = 0 $sql_and";
	$db->sql_query($sql);

	if ($auto_lock_flags & FORUM_FLAG_PRUNE_POLL)
	{
		$sql = 'UPDATE ' . TOPICS_TABLE . ' SET topic_status = ' . ITEM_LOCKED .
			' WHERE ' . $db->sql_in_set('forum_id', $forum_id) .
			' AND topic_status = ' . ITEM_UNLOCKED .
			" AND poll_start > 0 AND poll_last_vote < $auto_lock_date $sql_and";
		$db->sql_query($sql);
	}
}

/**
* Function autolocktopics(), this function now relies on passed vars
*/
function autolocktopics($forum_id, $auto_lock_mode, $auto_lock_flags, $auto_lock_days, $auto_lock_freq)
{
	global $db;

	$sql = 'SELECT forum_name
		FROM ' . FORUMS_TABLE . "
		WHERE forum_id = $forum_id";
	$result = $db->sql_query($sql, 3600);
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	if ($row)
	{
		$auto_lock_date = time() - ($auto_lock_days * 86400);
		$next_auto_lock = time() + ($auto_lock_freq * 86400);

		lock_topics($forum_id, $auto_lock_mode, $auto_lock_date, $auto_lock_flags, true);

		$sql = 'UPDATE ' . FORUMS_TABLE . "
			SET auto_lock_next = $next_auto_lock
			WHERE forum_id = $forum_id";
		$db->sql_query($sql);

		add_log('admin', 'LOG_AUTO_LOCK_TOPIC', $row['forum_name']);
	}

	return;
}
