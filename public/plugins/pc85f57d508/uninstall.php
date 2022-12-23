<?php

$dropColumns = array(
	array( 'core_members', 'profile_private' ),
	array( 'core_members', 'profile_ban_members' ),
);

foreach( $dropColumns as $column )
{
	try
	{
		call_user_func_array( array( \IPS\Db::i(), 'dropColumn' ), $column );
	}
	catch(\Exception $e){}
}