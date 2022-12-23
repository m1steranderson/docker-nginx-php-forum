<?php
/**
 * @brief		reports
 * @author		<a href='https://www.invisioncommunity.com'>Invision Power Services, Inc.</a>
 * @copyright	(c) Invision Power Services, Inc.
 * @license		https://www.invisioncommunity.com/legal/standards/
 * @package		Invision Community

 * @since		21 Sep 2021
 */

namespace IPS\core\modules\admin\activitystats;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !\defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * reports
 */
class _reports extends \IPS\Dispatcher\Controller
{
	/**
	 * Execute
	 *
	 * @return	void
	 */
	public function execute()
	{
		\IPS\Dispatcher::i()->checkAcpPermission( 'reportstats_manage' );
		parent::execute();
	}

	/**
	 * Manage
	 *
	 * @return	void
	 */
	protected function manage()
	{
		$chart	= new \IPS\Helpers\Chart\Database( \IPS\Http\Url::internal( 'app=core&module=activitystats&controller=reports' ), 'core_rc_reports', 'date_reported', '', array( 
			'isStacked' => FALSE,
			'backgroundColor' 	=> '#ffffff',
			'colors'			=> array( '#10967e' ),
			'hAxis'				=> array( 'gridlines' => array( 'color' => '#f5f5f5' ) ),
			'lineWidth'			=> 1,
			'areaOpacity'		=> 0.4
		 ) );
		$chart->addSeries( \IPS\Member::loggedIn()->language()->addToStack('stats_reports'), 'number', 'COUNT(*)', FALSE );
		$chart->title = \IPS\Member::loggedIn()->language()->addToStack('stats_reports_title');
		$chart->availableTypes = array( 'AreaChart', 'ColumnChart', 'BarChart' );


		\IPS\Output::i()->title = \IPS\Member::loggedIn()->language()->addToStack('menu__core_activitystats_reports');
		\IPS\Output::i()->output = (string) $chart;
	}
	
}