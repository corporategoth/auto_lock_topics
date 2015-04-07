<?php

/**
*
* Auto Lock Topics [Swedish]
* Swedish translation by Holger (http://www.maskinisten.net)
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
	'FORUM_AUTO_LOCK_SETTINGS'	=> 'Inställningar för automatisk låsning',
	'AUTO_LOCK_DAYS'		=> 'Låsning pga inläggets ålder',
	'AUTO_LOCK_DAYS_EXPLAIN'	=> 'Antal dagar sedan senaste inlägget tills tråden låses.',
	'AUTO_LOCK_FREQ'		=> 'Frekvens för automatisk låsning',
	'AUTO_LOCK_FREQ_EXPLAIN'	=> 'Dagar mellan rensning.',
	'AUTO_LOCK_VIEWED'		=> 'Låsning pga senaste visning av inlägget',
	'AUTO_LOCK_VIEWED_EXPLAIN'	=> 'Antal dagar sedan inlägget senast visades tills tråden låses.',
	'FORUM_AUTO_LOCK'		=> 'Aktivera automatisk låsning',
	'FORUM_AUTO_LOCK_EXPLAIN'	=> 'Lås ämnen automatiskt i forumet, ställ in frekvens/ålder-parametrar nedan.',
	'AUTO_LOCK_ANNOUNCEMENTS'	=> 'Lås anslag automatiskt',
	'AUTO_LOCK_STICKY'		=> 'Lås klistrade automatiskt',
	'AUTO_LOCK_OLD_POLLS'		=> 'Lås gamla omröstningar automatiskt',
	'AUTO_LOCK_OLD_POLLS_EXPLAIN'	=> 'Låser omröstningar som det ej har röstats i enligt inställningarna för inläggsålder.',
));
