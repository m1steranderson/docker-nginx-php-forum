//<?php
/**
 * @package		Traffic Generator
 * @author		<a href='http://www.invisionizer.com'>Invisionizer</a>
 * @copyright	(c) 2015 Invisionizer
 */

$form->addHeader('tGenerator_main_settings');
$form->add( new \IPS\Helpers\Form\YesNo( 'tGenerator_enable', \IPS\Settings::i()->tGenerator_enable, FALSE, array() ) );
$form->addHeader('tGenerator_members_settings');
$form->add( new \IPS\Helpers\Form\Number( 'tGenerator_max_members', \IPS\Settings::i()->tGenerator_max_members, FALSE, array() ) );
$form->add( new \IPS\Helpers\Form\Select( 'tGenerator_g', array_filter( explode( ',', \IPS\Settings::i()->tGenerator_g ) ), FALSE, array( 'options' => \IPS\Member\Group::groups( $showAdminGroups=TRUE, $showGuestGroups=FALSE ), 'parse' => 'normal', 'multiple' => TRUE ) ) );
$form->add( new \IPS\Helpers\Form\Number( 'tGenerator_max_posts', \IPS\Settings::i()->tGenerator_max_posts, FALSE, array() ) );
$form->addHeader('tGenerator_guest_settings');
$form->add( new \IPS\Helpers\Form\Number( 'tGenerator_max_guests', \IPS\Settings::i()->tGenerator_max_guests, FALSE, array() ) );

if ( $values = $form->values() )
{
	$form->saveAsSettings();
	return TRUE;
}

return $form;