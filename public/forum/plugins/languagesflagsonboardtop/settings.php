//<?php

$form->add( new \IPS\Helpers\Form\Select( 'langboardtop_type', \IPS\Settings::i()->langboardtop_type, TRUE, array( 'options' => array( 'flags' => 'langboardtop_flags', 'dropdown' => 'langboardtop_dropdown' ) ) ) );

if ( $values = $form->values() )
{
	$form->saveAsSettings();
	return TRUE;
}

return $form;