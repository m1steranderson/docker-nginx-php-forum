//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class hook24 extends _HOOK_CLASS_
{

/* !Hook Data - DO NOT REMOVE */
public static function hookData() {
 return array_merge_recursive( array (
  'profileHeader' => 
  array (
    0 => 
    array (
      'selector' => 'ul#elEditProfile',
      'type' => 'add_inside_start',
      'content' => '				<li>
					<a href=\'{$member->url()->setQueryString( \'do\', \'privacy\' )}\' class=\'ipsButton ipsButton_small ipsButton_overlaid\' data-ipsDialog data-ipsDialog-modal=\'true\' data-ipsdialog-size=\'medium\' data-ipsDialog-title=\'{lang="profile_private_title"}\'>
						<i class=\'fa fa-{{if !$member->profile_private AND !$member->profile_ban_members}}un{{endif}}lock\'></i> <span class=\'ipsResponsive_hidePhone ipsResponsive_inline\'>  {lang="profile_private_privacy"}</span>
					</a>
				</li>',
    ),
  ),
), parent::hookData() );
}
/* End Hook Data */


}
