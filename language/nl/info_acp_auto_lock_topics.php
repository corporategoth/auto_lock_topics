<?php

/**
*
* Auto Lock Topics [English]
*
* @package language
* @version $Id$
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* Vertaling: Rembert Oldenboom (http://www.floating-point.nl/) 2015-06-14
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
	'FORUM_AUTO_LOCK_SETTINGS'	=> 'Forum automatisch sluiten onderwerpen',
	'AUTO_LOCK_DAYS'		=> 'Automatisch sluiten bericht op ouderdom',
	'AUTO_LOCK_DAYS_EXPLAIN'	=> 'Het onderwerp wordt gesloten wanneer het aantal dagen sinds de laatste bijdrage deze waarde overschrijdt.',
	'AUTO_LOCK_FREQ'		=> 'Automatisch sluiten frequentie',
	'AUTO_LOCK_FREQ_EXPLAIN'	=> 'Het automatisch-sluiten proces wordt met tussenpozen van een aantal dagen uitgevoerd.',
	'AUTO_LOCK_VIEWED'		=> 'Automatisch sluiten bericht op bezoekers',
	'AUTO_LOCK_VIEWED_EXPLAIN'	=> 'Het onderwerp wordt gesloten wanneer het aantal dagen sinds het de laatste keer is bekeken deze waarde overschrijdt.',
	'FORUM_AUTO_LOCK'		=> 'Automatisch sluiten inschakelen',
	'FORUM_AUTO_LOCK_EXPLAIN'	=> 'Sluit onderwerpen op dit forum automatisch op basis van onderstaande settings.',
	'AUTO_LOCK_ANNOUNCEMENTS'	=> 'Aankondigingen automatisch sluiten',
	'AUTO_LOCK_STICKY'		=> 'Stickies automatisch sluiten',
	'AUTO_LOCK_OLD_POLLS'		=> 'Oude peilingen automatisch sluiten',
	'AUTO_LOCK_OLD_POLLS_EXPLAIN'	=> 'Onderwerpen met peilingen automatisch sluiten wanneer de waarde voor "automatisch sluiten bericht op ouderdom" wordt overschreden.',
));
