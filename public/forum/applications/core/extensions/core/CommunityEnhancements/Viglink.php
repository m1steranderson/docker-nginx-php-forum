<?php
/**
 * @brief		Community Enhancements: Viglink integration
 * @author		<a href='https://www.invisioncommunity.com'>Invision Power Services, Inc.</a>
 * @copyright	(c) Invision Power Services, Inc.
 * @license		https://www.invisioncommunity.com/legal/standards/
 * @package		Invision Community
 * @since		20 June 2013
 */

namespace IPS\core\extensions\core\CommunityEnhancements;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !\defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Community Enhancements: Viglink
 */
class _Viglink
{
	/**
	 * @brief	IPS-provided enhancement?
	 */
	public $ips	= FALSE;

	/**
	 * @brief	Enhancement is enabled?
	 */
	public $enabled	= FALSE;

	/**
	 * @brief	Enhancement has configuration options?
	 */
	public $hasOptions	= TRUE;

	/**
	 * @brief	Icon data
	 */
	public $icon	= "viglink.png";
	
	/**
	 * Constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		$this->enabled = ( \IPS\Settings::i()->viglink_enabled );
	}
	
	/**
	 * Edit
	 *
	 * @return	void
	 */
	public function edit()
	{
		\IPS\Output::i()->sidebar['actions'] = array(
			'help'		=> array(
				'title'		=> 'learn_more',
				'icon'		=> 'question-circle',
				'link'		=> \IPS\Http\Url::ips( 'docs/viglink' ),
				'target'	=> '_blank'
			)
		);
		
		if ( \IPS\Settings::i()->viglink_api_key )
		{
			$form = new \IPS\Helpers\Form;
		
			$form->add( new \IPS\Helpers\Form\YesNo( 'viglink_enabled', \IPS\Settings::i()->viglink_enabled, FALSE, array( 'togglesOn' => array( 'viglink_api_key', 'viglink_subid', 'viglink_groups', 'viglink_norewrite' ) ) ) );
			
			if ( !\IPS\Settings::i()->viglink_subid )
			{
				$form->add( new \IPS\Helpers\Form\Text( 'viglink_api_key', \IPS\Settings::i()->viglink_api_key, FALSE, array(), NULL, NULL, NULL, 'viglink_api_key' ) );
			}

			$form->add( new \IPS\Helpers\Form\CheckboxSet( 'viglink_groups', ( \IPS\Settings::i()->viglink_groups == 'all' ) ? 'all' : explode( ',', \IPS\Settings::i()->viglink_groups ), FALSE, array( 'options' => \IPS\Member\Group::groups(), 'parse' => 'normal', 'multiple' => true, 'unlimited' => 'all', 'unlimitedLang' => 'all_groups', 'impliedUnlimited' => TRUE ), NULL, NULL, NULL, 'viglink_groups' ) );
			$form->add( new \IPS\Helpers\Form\CheckboxSet( 'viglink_norewrite', explode( ',', \IPS\Settings::i()->viglink_norewrite ), FALSE, array( 'options' => \IPS\Member\Group::groups(), 'parse' => 'normal', 'multiple' => true ), NULL, NULL, NULL, 'viglink_norewrite' ) );
	
			if ( $values = $form->values( TRUE ) )
			{
				if ( !$values['viglink_enabled'] )
				{
					$values['viglink_api_key'] = '';
				}
				
				$form->saveAsSettings( $values );
				\IPS\Session::i()->log( 'acplog__enhancements_edited', array( 'enhancements__core_Viglink' => TRUE ) );
				\IPS\Output::i()->inlineMessage	= \IPS\Member::loggedIn()->language()->addToStack('saved');
			}
			
			\IPS\Output::i()->sidebar['actions']['signup'] = array(
				'title'		=> 'viglink_account_type',
				'icon'		=> 'external-link-square',
				'link'		=> \IPS\Http\Url::ips('docs/viglink_account'),
				'target'	=> '_blank'
			);
			
			\IPS\Output::i()->output = \IPS\Theme::i()->getTemplate( 'global' )->block( 'enhancements__core_Viglink', $form );

		}
		else
		{
            $form = new \IPS\Helpers\Form;
			$form->add( new \IPS\Helpers\Form\Text( 'viglink_api_key', NULL, FALSE, array(), function( $val ){
				if( !$val && \IPS\Request::i()->viglink_account_type == 'existing' )
				{
					throw new \InvalidArgumentException("required");
				}
			}, NULL, NULL, 'viglink_api_key' ) );
			
			if ( $values = $form->values() )
			{
                $values['viglink_subid'] = '';
				$values['viglink_enabled'] = TRUE;
				unset( $values['viglink_account_type'] );
				$form->saveAsSettings( $values );
				\IPS\Session::i()->log( 'acplog__enhancements_edited', array( 'enhancements__core_Viglink' => TRUE ) );
				\IPS\Output::i()->inlineMessage	= \IPS\Member::loggedIn()->language()->addToStack('saved');
			}
		}
		
		\IPS\Output::i()->output = $form;
	}
	
	/**
	 * Enable/Disable
	 *
	 * @param	$enabled	bool	Enable/Disable
	 * @return	void
	 * @throws	\DomainException
	 */
	public function toggle( $enabled )
	{
		/* If we're disabling, just disable */
		if( !$enabled )
		{
			\IPS\Settings::i()->changeValues( array( 'viglink_enabled' => 0 ) );
		}

		/* Otherwise if we already have an API key, just toggle on */
		if( $enabled && \IPS\Settings::i()->viglink_api_key )
		{
			\IPS\Settings::i()->changeValues( array( 'viglink_enabled' => 1 ) );
		}
		/* Otherwise we need to let them enter an API key before we can enable.  Throwing an exception causes you to be redirected to the settings page. */
		else
		{
			throw new \DomainException;
		}
	}
}