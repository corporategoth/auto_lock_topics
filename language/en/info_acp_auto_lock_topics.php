<?php

/**
*
* Auto Lock Topics [English]
*
* @package language
* @version $Id$
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'FORUM_AUTO_LOCK_SETTINGS'	=> 'Forum auto lock settings',
	'AUTO_LOCK_DAYS'		=> 'Auto lock post age',
	'AUTO_LOCK_DAYS_EXPLAIN'	=> 'Number of days since last post after which topic is locked.',
	'AUTO_LOCK_FREQ'		=> 'Auto lock frequency',
	'AUTO_LOCK_FREQ_EXPLAIN'	=> 'Time in days between pruning events.',
	'AUTO_LOCK_VIEWED'		=> 'Auto lock post viewed age',
	'AUTO_LOCK_VIEWED_EXPLAIN'	=> 'Number of days since topic was viewed after which topic is locked.',
	'FORUM_AUTO_LOCK'		=> 'Enable auto locking',
	'FORUM_AUTO_LOCK_EXPLAIN'	=> 'Auto lock the forum of topics, set the frequency/age parameters below.',
	'AUTO_LOCK_ANNOUNCEMENTS'	=> 'Auto lock announcements',
	'AUTO_LOCK_STICKY'		=> 'Auto lock stickies',
	'AUTO_LOCK_OLD_POLLS'		=> 'Auto lock old polls',
	'AUTO_LOCK_OLD_POLLS_EXPLAIN'	=> 'Locks topics with polls not voted in for post age days.',
));
