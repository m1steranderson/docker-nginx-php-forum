//<?php

class hook23 extends _HOOK_CLASS_
{

/* !Hook Data - DO NOT REMOVE */
public static function hookData() {
 return array_merge_recursive( array (
  'userBar' => 
  array (
    0 => 
    array (
      'selector' => '#elUserNav',
      'type' => 'add_inside_end',
      'content' => '{{if ( \IPS\Settings::i()->site_online || \IPS\Member::loggedIn()->group[\'g_access_offline\'] ) and ( \IPS\Dispatcher::i()->application instanceof \IPS\Application AND \IPS\Dispatcher::i()->application->canAccess() )}}
	{template="langBoardTop" group="plugins" location="global" app="core" params=""}
{{endif}}',
    ),
  ),
), parent::hookData() );
}
/* End Hook Data */
























































































}