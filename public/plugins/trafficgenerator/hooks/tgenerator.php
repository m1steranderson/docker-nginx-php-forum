//<?php

/**
 * @package      Traffic Generator
 * @author       <a href='http://www.invisionizer.com'>Invisionizer</a>
 * @copyright    (c) 2015 Invisionizer
 */
class hook21 extends _HOOK_CLASS_
{
    public function init()
    {
	try
	{
		try
		{
		        parent::init();
		
		        if ( \IPS\Settings::i()->tGenerator_enable ) {
		
		            /* Members */
		            $maxMembers        = isset( \IPS\Settings::i()->tGenerator_max_members ) ? \IPS\Settings::i()->tGenerator_max_members : 0;;
		            $sessionExpiration = ( time() + ( 30 * 60 ) );
		
		            $where = array(
		                array( 'core_sessions.login_type=' . 0 ),
		                array( 'core_sessions.running_time <' . $sessionExpiration ),
		                array( 'core_sessions.member_id IS NOT NULL' ),
		                array( 'core_sessions.is_generated=1' )
		            );
		
		            # Check if we got max members online
		            $sessionsMembers = \IPS\Db::i()->select( 'core_sessions.id,core_sessions.member_id,core_sessions.member_name,core_sessions.seo_name,core_sessions.member_group,core_sessions.is_generated,core_sessions.generated_expire', 'core_sessions', $where, 'core_sessions.running_time DESC', 60, NULL, NULL)->join( 'core_members', 'core_members.member_id=core_sessions.member_id' )->join( 'core_groups', 'core_members.member_group_id=core_groups.g_id' )->setKeyField( 'member_id' );
		            $memberCount     = $sessionsMembers->count( true );
	
		            $members = iterator_to_array( $sessionsMembers );
		
		            foreach( $members as $row ) {
		                if(time() > $row['generated_expire']) {
		                    \IPS\Db::i()->delete( 'core_sessions', array( 'id=?', $row['id'] ) );
		
		                }
		            }
	
		            if ( $memberCount < $maxMembers ) {
		
		                $limit = $maxMembers;
		                $order = 'RAND()';
		
		                $whereMembers = array(
		                    array( 'last_visit <' . $sessionExpiration ),
		                    array( 'member_posts >=' . \IPS\Settings::i()->tGenerator_max_posts )
		                );
		
		                $groups = array_filter( explode( ',', \IPS\Settings::i()->tGenerator_g ) );
		
		                if ( count( $groups ) ) {
		                    $whereMembers[] = '(  ( ' . \IPS\Db::i()->in( 'member_group_id', $groups ) . ' ) ) OR (  ( ' . \IPS\Db::i()->in( 'mgroup_others', $groups ) . ' ) )';
		                }
		
		                $getMembers = \IPS\Db::i()->select( 'core_members.member_id', 'core_members', $whereMembers, $order, $limit, NULL, NULL)->join( 'core_sessions', 'core_sessions.member_id=core_members.member_id' )->join( 'core_groups', 'core_members.member_group_id=core_groups.g_id' )->setKeyField( 'member_id' );
	
		                foreach ( $getMembers as $row ) {
		
		                    $members = \IPS\Member::load( $row );
	
		                    if ( !$members->isOnline() ) {
		                        $sessionCreated = ( time() + rand( 1, 3 * 60 ) );
		                        $locations      = $this->randLocationMembers();
		                        $userAgents     = $this->userAgents();
		                        $browser        = $this->browserData();
		
		                        $data = array( 'id'                   => md5( uniqid( microtime() ) ),
		                                       'member_name'          => $members->name,
		                                       'seo_name'             => $members->members_seo_name,
		                                       'member_id'            => $members->member_id,
		                                       'ip_address'           => $members->ip_address,
		                                       'browser'              => $userAgents,
		                                       'running_time'         => $sessionCreated,
		                                       'login_type'           => 0,
		                                       'member_group'         => $members->member_group_id,
		                                       'data'                 => NULL,
		                                       'current_appcomponent' => $locations['app'],
		                                       'current_module'       => $locations['module'],
		                                       'current_controller'   => $locations['controller'],
		                                       'location_url'         => $locations['url'],
		                                       'location_lang'        => $locations['lang'],
		                                       'location_data'        => $locations['location_data'],
		                                       'current_id'           => $locations['current_id'],
		                                       'uagent_key'           => $browser['browsers'],
		                                       'uagent_version'       => $browser['versions'],
		                                       'uagent_type'          => $browser['type'],
		                                       'is_generated'         => 1,
		                                       'generated_expire'     => $sessionExpiration
		
		                        );
		
		                        \IPS\Db::i()->insert( 'core_sessions', $data );
		
		                        $members->last_visit    = $sessionCreated;
		                        $members->last_activity = $sessionCreated;
		                        $members->save();
		
		                    }
		
		                }
		            }
		
		            $whereGuest = array(
		                array( 'core_sessions.login_type=' . 2 ),
		                array( 'core_sessions.running_time <' . $sessionExpiration ),
		                array( 'core_sessions.member_id IS NULL' ),
		                array( 'core_sessions.is_generated=1' )
		            );
		
		            /* Guest */
		            $sessionsGuests = \IPS\Db::i()->select( 'core_sessions.id,core_sessions.member_id,core_sessions.member_name,core_sessions.seo_name,core_sessions.member_group,core_sessions.is_generated,core_sessions.generated_expire', 'core_sessions', $whereGuest, 'core_sessions.running_time DESC', 60, NULL, NULL);
		            $maxGuest       = isset( \IPS\Settings::i()->tGenerator_max_guests ) ? \IPS\Settings::i()->tGenerator_max_guests : 0;
		            $guestCount     = $sessionsGuests->count( true );
		
		            $guests = iterator_to_array( $sessionsGuests );
		
		            foreach( $guests as $row ) {
		                if(time() > $row['generated_expire']) {
		                    \IPS\Db::i()->delete( 'core_sessions', array( 'id=?', $row['id'] ) );
		
		                }
		            }
		
		            if ( $guestCount < $maxGuest ) {
		                $max = $maxGuest - $guestCount;
		
		                for ( $i = 0; $i < ( $max ); $i ++ ) {
		                    $sessionCreated = time() - rand( 1, ( ( 30 - 1 ) * 60 ) );
		
		                    $locations = $this->randLocationGuest();
		
		                    $userAgents = $this->userAgents();
		                    $browser    = $this->browserData();
		
		                    $data = array( 'id'                   => md5( uniqid( microtime() ) ),
		                                   'member_name'          => '',
		                                   'seo_name'             => '',
		                                   'member_id'            => NULL,
		                                   'ip_address'           => long2ip( mt_rand() ),
		                                   'browser'              => $userAgents,
		                                   'running_time'         => $sessionCreated,
		                                   'login_type'           => 2,
		                                   'member_group'         => \IPS\Settings::i()->guest_group,
		                                   'data'                 => NULL,
		                                   'current_appcomponent' => $locations['app'],
		                                   'current_module'       => $locations['module'],
		                                   'current_controller'   => $locations['controller'],
		                                   'location_url'         => $locations['url'],
		                                   'location_lang'        => $locations['lang'],
		                                   'location_data'        => $locations['location_data'],
		                                   'current_id'           => $locations['current_id'],
		                                   'uagent_key'           => $browser['browsers'],
		                                   'uagent_version'       => $browser['versions'],
		                                   'uagent_type'          => $browser['type'],
		                                   'is_generated'         => 1,
		                                   'generated_expire'     => $sessionExpiration
		                    );
		
		                    \IPS\Db::i()->insert( 'core_sessions', $data );
		                }
		            }
		        }
		}
		catch ( \RuntimeException $e )
		{
			if ( method_exists( get_parent_class(), __FUNCTION__ ) )
			{
				return call_user_func_array( 'parent::' . __FUNCTION__, func_get_args() );
			}
			else
			{
				throw $e;
			}
		}
	}
	catch ( \RuntimeException $e )
	{
		if ( method_exists( get_parent_class(), __FUNCTION__ ) )
		{
			return call_user_func_array( 'parent::' . __FUNCTION__, func_get_args() );
		}
		else
		{
			throw $e;
		}
	}
    }

    public function randLocationMembers()
    {
	try
	{
		try
		{
		        $locations = array();
		
		        $locations['generate'] = array( 'index', 'messenger', 'online', 'topic' );
		
		        $k                     = array_rand( $locations['generate'] );
		        $locations['generate'] = $locations['generate'][$k];
		
		        switch ( $locations['generate'] ) {
		            case 'index':
		                $locations['url']        = \IPS\Http\Url::internal( "app=forums&module=forums&controller=index", 'front', 'forums' );
		                $locations['lang']       = "loc_forums_index";
		                $locations['app']        = 'forums';
		                $locations['module']     = 'forums';
		                $locations['controller'] = 'index';
		                break;
		            case 'messenger':
		                $locations['url']        = \IPS\Http\Url::internal( "app=core&module=messaging&controller=messenger", NULL, 'messenger' );
		                $locations['lang']       = "loc_using_messenger";
		                $locations['app']        = 'core';
		                $locations['module']     = 'messaging';
		                $locations['controller'] = 'messenger';
		                break;
		            case 'online':
		                $locations['url']        = \IPS\Http\Url::internal( "app=core&module=online&controller=online", 'front', 'online' );
		                $locations['lang']       = "loc_viewing_online_users";
		                $locations['app']        = 'core';
		                $locations['module']     = 'system';
		                $locations['controller'] = 'online';
		                break;
		            case 'topic':
		                $topic                      = \IPS\Db::i()->select( '*', 'forums_topics', array(), 'RAND()', 1 )->first();
		                $locations['url']           = \IPS\Http\Url::internal( "app=forums&module=forums&controller=topic&id={$topic['tid']}", 'front', 'forums_topic', array( $topic['title_seo'] ) );
		                $locations['lang']          = "loc_forums_viewing_topic";
		                $locations['app']           = 'forums';
		                $locations['module']        = 'forums';
		                $locations['controller']    = 'topic';
		                $locations['current_id']    = $topic['tid'];
		                $locations['location_data'] = json_encode( array( $topic['title'] => FALSE ) );
		                break;
		        }
		
		        return $locations;
		}
		catch ( \RuntimeException $e )
		{
			if ( method_exists( get_parent_class(), __FUNCTION__ ) )
			{
				return call_user_func_array( 'parent::' . __FUNCTION__, func_get_args() );
			}
			else
			{
				throw $e;
			}
		}
	}
	catch ( \RuntimeException $e )
	{
		if ( method_exists( get_parent_class(), __FUNCTION__ ) )
		{
			return call_user_func_array( 'parent::' . __FUNCTION__, func_get_args() );
		}
		else
		{
			throw $e;
		}
	}
    }

    public function randLocationGuest()
    {
	try
	{
		try
		{
		        $locations = array();
		
		        $locations['generate'] = array( 'index', 'login', 'privacy', 'register', 'online', 'topic' );
		
		        $k                     = array_rand( $locations['generate'] );
		        $locations['generate'] = $locations['generate'][$k];
		
		        switch ( $locations['generate'] ) {
		            case 'index':
		                $locations['url']        = \IPS\Http\Url::internal( "app=forums&module=forums&controller=index", 'front', 'forums' );
		                $locations['lang']       = "loc_forums_index";
		                $locations['app']        = 'forums';
		                $locations['module']     = 'forums';
		                $locations['controller'] = 'index';
		                break;
		            case 'login':
		                $locations['url']        = \IPS\Http\Url::internal( "app=core&module=system&controller=login", 'front', 'login' );
		                $locations['lang']       = "loc_logging_in";
		                $locations['app']        = 'core';
		                $locations['module']     = 'system';
		                $locations['controller'] = 'login';
		                break;
		            case 'privacy':
		                $locations['url']        = \IPS\Http\Url::internal( "app=core&module=system&controller=privacy", NULL, 'privacy' );
		                $locations['lang']       = "loc_viewing_privacy_policy";
		                $locations['app']        = 'core';
		                $locations['module']     = 'system';
		                $locations['controller'] = 'privacy';
		                break;
		            case 'register':
		                $locations['url']        = \IPS\Http\Url::internal( "app=core&module=system&controller=login", NULL, 'register' );
		                $locations['lang']       = "loc_registering";
		                $locations['app']        = 'core';
		                $locations['module']     = 'system';
		                $locations['controller'] = 'register';
		                break;
		            case 'online':
		                $locations['url']        = \IPS\Http\Url::internal( "app=core&module=online&controller=online", 'front', 'online' );
		                $locations['lang']       = "loc_viewing_online_users";
		                $locations['app']        = 'core';
		                $locations['module']     = 'system';
		                $locations['controller'] = 'online';
		                break;
		            case 'topic':
		                $topic                      = \IPS\Db::i()->select( '*', 'forums_topics', array(), 'RAND()', 1 )->first();
		                $locations['url']           = \IPS\Http\Url::internal( "app=forums&module=forums&controller=topic&id={$topic['tid']}", 'front', 'forums_topic', array( $topic['title_seo'] ) );
		                $locations['lang']          = "loc_forums_viewing_topic";
		                $locations['app']           = 'forums';
		                $locations['module']        = 'forums';
		                $locations['controller']    = 'topic';
		                $locations['current_id']    = $topic['tid'];
		                $locations['location_data'] = json_encode( array( $topic['title'] => FALSE ) );
		                break;
		        }
		
		        return $locations;
		}
		catch ( \RuntimeException $e )
		{
			if ( method_exists( get_parent_class(), __FUNCTION__ ) )
			{
				return call_user_func_array( 'parent::' . __FUNCTION__, func_get_args() );
			}
			else
			{
				throw $e;
			}
		}
	}
	catch ( \RuntimeException $e )
	{
		if ( method_exists( get_parent_class(), __FUNCTION__ ) )
		{
			return call_user_func_array( 'parent::' . __FUNCTION__, func_get_args() );
		}
		else
		{
			throw $e;
		}
	}
    }

    public function userAgents()
    {
	try
	{
		try
		{
		        $agents = array( 0 => "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36",
		                         1 => "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36",
		                         2 => "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0",
		                         3 => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/600.5.17 (KHTML, like Gecko) Version/8.0.5 Safari/600.5.17",
		                         4 => "Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36",
		                         5 => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36",
		                         6 => "Mozilla/5.0 (Windows NT 6.3; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0"
		        );
		
		        $k          = array_rand( $agents );
		        $userAgents = $agents[$k];
		
		        return $userAgents;
		
		}
		catch ( \RuntimeException $e )
		{
			if ( method_exists( get_parent_class(), __FUNCTION__ ) )
			{
				return call_user_func_array( 'parent::' . __FUNCTION__, func_get_args() );
			}
			else
			{
				throw $e;
			}
		}
	}
	catch ( \RuntimeException $e )
	{
		if ( method_exists( get_parent_class(), __FUNCTION__ ) )
		{
			return call_user_func_array( 'parent::' . __FUNCTION__, func_get_args() );
		}
		else
		{
			throw $e;
		}
	}
    }

    public function browserData()
    {
	try
	{
		try
		{
		        $browsers = array();
		
		        $browsers['browsers'] = array( 'explorer', 'firefox', 'chrome', 'safari', 'opera' );
		
		        $k                    = array_rand( $browsers['browsers'] );
		        $browsers['browsers'] = $browsers['browsers'][$k];
		
		        switch ( $browsers['browsers'] ) {
		            case 0:
		                $browsers['versions'] = mt_rand( 1, 11 );
		                break;
		            case 1:
		                $browsers['versions'] = mt_rand( 1, 37 );
		                break;
		            case 2:
		                $browsers['versions'] = mt_rand( 1, 41 );
		                break;
		            case 3:
		                $browsers['versions'] = mt_rand( 1, 8 );
		                break;
		            case 4:
		                $browsers['versions'] = mt_rand( 1, 28 );
		                break;
		        }
		
		        $browsers['type'] = 'browser';
		
		        return $browsers;
		}
		catch ( \RuntimeException $e )
		{
			if ( method_exists( get_parent_class(), __FUNCTION__ ) )
			{
				return call_user_func_array( 'parent::' . __FUNCTION__, func_get_args() );
			}
			else
			{
				throw $e;
			}
		}
	}
	catch ( \RuntimeException $e )
	{
		if ( method_exists( get_parent_class(), __FUNCTION__ ) )
		{
			return call_user_func_array( 'parent::' . __FUNCTION__, func_get_args() );
		}
		else
		{
			throw $e;
		}
	}
    }
}