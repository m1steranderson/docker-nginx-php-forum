//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class hook25 extends _HOOK_CLASS_
{

	/**
	 * Main execute entry point - used to override breadcrumb
	 *
	 * @return void
	 */
	public function execute()
	{
		try
		{
			$this->member = \IPS\Member::load( \IPS\Request::i()->id );
			if( $this->member->member_id AND \IPS\Member::loggedIn()->member_id !== $this->member->member_id AND !\IPS\Member::loggedIn()->isAdmin() )
			{
				switch( $this->member->profile_private )
				{
					case 1:
						if( !\IPS\Member::loggedIn()->member_id )
						{
							\IPS\Output::i()->error( 'profile_private_members', 'PP/1', 403 );
						}
					break;
					case 2:
						if( !\IPS\Member::loggedIn()->member_id OR !iterator_to_array( \IPS\Db::i()->select( 'follow_member_id', 'core_follow', array( 'follow_app=? AND follow_area=? AND follow_rel_id=? AND follow_member_id=?', 'core', 'member', $this->member->member_id, \IPS\Member::loggedIn()->member_id ) ) )[0] )
						{
							\IPS\Output::i()->error( 'profile_private_followers', 'PP/2', 403 );
						}
					break;
					case 3:
						\IPS\Output::i()->error( 'profile_private_locked', 'PP/3', 403 );
					break;
				}
				
				if( $this->member->profile_ban_members AND in_array( \IPS\Member::loggedIn()->member_id, explode( ',', $this->member->profile_ban_members ) ) )
				{
					\IPS\Output::i()->error( 'profile_private_banned', 'PP/4', 403 );
				}
			}
			
			parent::execute();
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
	
	/*
	 * Private profile
	 *
	 * @return void
	 */
	public function privacy()
	{
		try
		{
			if( !\IPS\Member::loggedIn()->modPermission('can_modify_profiles') and ( \IPS\Member::loggedIn()->member_id !== $this->member->member_id or !$this->member->group['g_edit_profile'] ) )
			{
				\IPS\Output::i()->error( 'no_permission_edit_profile', 'PP/10', 403 );
			}
		
			$form = new \IPS\Helpers\Form;
			$form->add( new \IPS\Helpers\Form\Radio( 'profile_private', $this->member->profile_private, TRUE, array( 'options' => array( 
				0 => 'profile_private_0',
				1 => 'profile_private_1',
				2 => 'profile_private_2',
				3 => 'profile_private_3'
			) ) ) );
			
			$ban_members = $this->member->profile_ban_members ? array_filter( explode( ',', $this->member->profile_ban_members ), 'intval' ) : NULL;
			$form->add( new \IPS\Helpers\Form\Member( 'profile_ban_members', $ban_members ? iterator_to_array( \IPS\Db::i()->select( 'name', 'core_members', \IPS\Db::i()->in( 'member_id', $ban_members ) ) ) : NULL, FALSE, array( 'multiple' => 0 ) ) );
			
			if( $values = $form->values() )
			{
				$this->member->profile_private = intval( $values['profile_private'] );
				
				if( is_array( $values['profile_ban_members'] ) )
				{
					$this->member->profile_ban_members = implode( ',', array_filter( array_keys( $values['profile_ban_members'] ), 'intval' ) );
				}
				
				$this->member->save();
				
				\IPS\Output::i()->redirect( $this->member->url(), 'saved' );
			}
			
			\IPS\Output::i()->title = \IPS\Member::loggedIn()->language()->addToStack( 'profile_private_title' );
			
			if ( \IPS\Request::i()->isAjax() )
			{
				\IPS\Output::i()->output = $form->customTemplate( array( call_user_func_array( array( \IPS\Theme::i(), 'getTemplate' ), array( 'forms', 'core' ) ), 'popupTemplate' ) );
			}
			else
			{
				\IPS\Output::i()->output = \IPS\Theme::i()->getTemplate( 'forms', 'core' )->editContentForm( \IPS\Member::loggedIn()->language()->addToStack( 'profile_private_title' ), $form );
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
