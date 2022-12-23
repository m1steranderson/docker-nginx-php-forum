<?php

return <<<'VALUE'
"namespace IPS\\Theme;\nclass class_core_global_members extends \\IPS\\Theme\\Template\n{\n\tpublic $cache_key = '4060f97b70ce5ec3ce3bbd24c102e5df';\n\tfunction attachmentLocations( $locations, $truncateLinks=TRUE ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n\nCONTENT;\n\nif ( \\count( $locations ) ):\n$return .= <<<CONTENT\n\n\t<ul class=\"ipsList_reset\">\n\t\t\nCONTENT;\n\nforeach ( $locations as $location ):\n$return .= <<<CONTENT\n\n\t\t\t<li>\n\t\t\t\t\nCONTENT;\n\nif ( $location instanceof \\IPS\\Content or $location instanceof \\IPS\\Node\\Model ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t<a href=\"\nCONTENT;\n\nif ( \\IPS\\Dispatcher::i()->controllerLocation == 'admin' ):\n$return .= <<<CONTENT\n\nCONTENT;\n\nif ( method_exists( $location, 'acpUrl' ) ):\n$return .= <<<CONTENT\n\nCONTENT;\n$return .= htmlspecialchars( $location->acpUrl(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\n\nCONTENT;\n$return .= htmlspecialchars( $location->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\n\nCONTENT;\n$return .= htmlspecialchars( $location->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\" target=\"_blank\" rel=\"noreferrer\" class=\"ipsType_blendLinks\">\n\t\t\t\t\t\t\nCONTENT;\n\nif ( isset( $location::$icon ) ):\n$return .= <<<CONTENT\n<i class=\"fa fa-\nCONTENT;\n$return .= htmlspecialchars( $location::$icon, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" \nCONTENT;\n\nif ( isset( $location::$title ) ):\n$return .= <<<CONTENT\ntitle=\"\nCONTENT;\n\n$val = \"{$location::$title}\"; $return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n\" data-ipsTooltip\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n><\/i> \nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\nCONTENT;\n\nif ( $location instanceof \\IPS\\Content\\Item ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t\nCONTENT;\n$return .= htmlspecialchars( $location->mapped('title'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\nCONTENT;\n\nelseif ( $location instanceof \\IPS\\Node\\Model ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t\nCONTENT;\n$return .= htmlspecialchars( $location->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t\nCONTENT;\n$return .= htmlspecialchars( $location->item()->mapped('title'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t\t\t<\/a>\n\t\t\t\t\nCONTENT;\n\nelseif ( $location instanceof \\IPS\\Http\\Url ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t<a href=\"\nCONTENT;\n\nif ( \\IPS\\Dispatcher::i()->controllerLocation == 'admin' ):\n$return .= <<<CONTENT\n\nCONTENT;\n$return .= htmlspecialchars( $location, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\n\nCONTENT;\n$return .= htmlspecialchars( $location, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\" class=\"ipsType_blendLinks\" target=\"_blank\" rel=\"noreferrer\"\nCONTENT;\n\nif ( $truncateLinks ):\n$return .= <<<CONTENT\n title=\"\nCONTENT;\n$return .= htmlspecialchars( $location, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\"\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n>\n\t\t\t\t\t\t\nCONTENT;\n\nif ( $truncateLinks ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t\nCONTENT;\n\n$return .= htmlspecialchars( mb_substr( html_entity_decode( $location ), '0', \"60\" ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE ) . ( ( mb_strlen( html_entity_decode( $location ) ) > \"60\" ) ? '&hellip;' : '' );\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t\nCONTENT;\n$return .= htmlspecialchars( $location, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t\t\t<\/a>\n\t\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t<\/li>\n\t\t\nCONTENT;\n\nendforeach;\n$return .= <<<CONTENT\n\n\t<\/ul>\n\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\n\n\t<p class=\"\">\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'attach_locations_empty', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/p>\n\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction bdayForm_day( $name, $value, $error='' ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n\n<select name=\"bday[day]\">\n\t<option value='0' \nCONTENT;\n\nif ( $value['day'] == 0  ):\n$return .= <<<CONTENT\nselected\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n><\/option>\n\t\nCONTENT;\n\nforeach ( range( 1, 31 ) as $day ):\n$return .= <<<CONTENT\n\n\t\t<option value='\nCONTENT;\n$return .= htmlspecialchars( $day, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' \nCONTENT;\n\nif ( $value['day'] == $day  ):\n$return .= <<<CONTENT\nselected\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n>\nCONTENT;\n$return .= htmlspecialchars( $day, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n<\/option>\n\t\nCONTENT;\n\nendforeach;\n$return .= <<<CONTENT\n\n<\/select>\n\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction bdayForm_month( $name, $value, $error='' ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n\n<select name=\"bday[month]\">\n\t<option value='0' \nCONTENT;\n\nif ( $value['month'] == 0  ):\n$return .= <<<CONTENT\nselected\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n><\/option>\n\t\nCONTENT;\n\nforeach ( range( 1, 12 ) as $month ):\n$return .= <<<CONTENT\n\n\t\t<option value='\nCONTENT;\n$return .= htmlspecialchars( $month, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' \nCONTENT;\n\nif ( $value['month'] == $month  ):\n$return .= <<<CONTENT\nselected\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n>\nCONTENT;\n\n$return .= htmlspecialchars( \\IPS\\DateTime::create()->setDate( 2000, $month, 15 )->strFormat('%B'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n<\/option>\n\t\nCONTENT;\n\nendforeach;\n$return .= <<<CONTENT\n\n<\/select>\n\n\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction bdayForm_year( $name, $value, $error='', $required=FALSE ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n<select name=\"bday[year]\">\n    \nCONTENT;\n\nif ( !$required  ):\n$return .= <<<CONTENT\n\n\t<option value='0'>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'not_telling', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/option>\n    \nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\nCONTENT;\n\nforeach ( array_reverse( range( date('Y') - 150, date('Y') ) ) as $year ):\n$return .= <<<CONTENT\n\n\t\t<option value='\nCONTENT;\n$return .= htmlspecialchars( $year, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' \nCONTENT;\n\nif ( $value['year'] == $year  ):\n$return .= <<<CONTENT\nselected\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n>\nCONTENT;\n$return .= htmlspecialchars( $year, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n<\/option>\n\t\nCONTENT;\n\nendforeach;\n$return .= <<<CONTENT\n\n<\/select>\n\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction dateFilters( $dateRange, $element ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n<ul class='ipsField_fieldList'>\n\t<li>\n\t\t<span class='ipsCustomInput'>\n\t\t\t<input name=\"\nCONTENT;\n$return .= htmlspecialchars( $element->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n[2]\" value='none' type='radio' id='\nCONTENT;\n$return .= htmlspecialchars( $element->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n[3]_radio'\nCONTENT;\n\nif ( empty($element->value[0]) AND empty($element->value[1]) AND empty($element->value[3]) ):\n$return .= <<<CONTENT\n checked\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n> \n\t\t\t<span><\/span>\n\t\t<\/span>\n\t\t<div class='ipsField_fieldList_content'>\n\t\t\t\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'any_time', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n\n\t\t<\/div>\n\t<\/li>\n\t<li>\n\t\t<span class='ipsCustomInput ipsSpacer_top ipsSpacer_half'>\n\t\t\t<input name=\"\nCONTENT;\n$return .= htmlspecialchars( $element->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n[2]\" value='range' type='radio' id='\nCONTENT;\n$return .= htmlspecialchars( $element->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n[3]_radio' data-control=\"toggle\" data-toggles=\"\"\nCONTENT;\n\nif ( $element->value[0] ):\n$return .= <<<CONTENT\n checked\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n> \n\t\t\t<span><\/span>\n\t\t<\/span>\n\t\t<div class='ipsField_fieldList_content'>\n\t\t\t{$dateRange->html()}\n\t\t<\/div>\n\t<\/li>\n\t<li>\n\t\t<span class='ipsCustomInput ipsSpacer_top ipsSpacer_half'>\n\t\t\t<input name=\"\nCONTENT;\n$return .= htmlspecialchars( $element->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n[2]\" value='days' type='radio' id='\nCONTENT;\n$return .= htmlspecialchars( $element->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n[3]_radio'\nCONTENT;\n\nif ( $element->value[1] ):\n$return .= <<<CONTENT\n checked\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n> \n\t\t\t<span><\/span>\n\t\t<\/span>\n\t\t<div class='ipsField_fieldList_content'>\n\t\t\t\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'or_more_than', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n\n\t\t\t\nCONTENT;\n\n$return .= \\IPS\\Theme::i()->getTemplate( \"forms\", \"core\", 'global' )->number( $element->name . '[1]', $element->value[1], $element->required, NULL, FALSE, 0, NULL, 1, 0, NULL, FALSE, \\IPS\\Member::loggedIn()->language()->addToStack( 'days_ago' ), array(), TRUE, array(), $element->name . '_number' );\n$return .= <<<CONTENT\n\n\t\t<\/div>\n\t<\/li>\n\t<li>\n\t\t<span class='ipsCustomInput ipsSpacer_top ipsSpacer_half'>\n\t\t\t<input name=\"\nCONTENT;\n$return .= htmlspecialchars( $element->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n[2]\" value='days_lt' type='radio' id='\nCONTENT;\n$return .= htmlspecialchars( $element->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n[3]_radio'\nCONTENT;\n\nif ( ! empty( $element->value[3]) ):\n$return .= <<<CONTENT\n checked\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n> \n\t\t\t<span><\/span>\n\t\t<\/span>\n\t\t<div class='ipsField_fieldList_content'>\n\t\t\t\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'or_less_than', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n\n\t\t\t\nCONTENT;\n\n$return .= \\IPS\\Theme::i()->getTemplate( \"forms\", \"core\", 'global' )->number( $element->name . '[3]', isset( $element->value[3] ) ? $element->value[3] : NULL, $element->required, NULL, FALSE, 0, NULL, 1, 0, NULL, FALSE, \\IPS\\Member::loggedIn()->language()->addToStack( 'days_ago' ), array(), TRUE, array(), $element->name . '_number_lt' );\n$return .= <<<CONTENT\n\n\t\t<\/div>\n\t<\/li>\n<\/ul>\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction ipLookup( $url, $geolocation, $map, $hostName, $counts ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n\n<h2 class='ipsBox_titleBar ipsType_reset'>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ip_address_info', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/h2>\n<div class='ipsPad ipsAreaBackground_light cIPInfo'>\n\t\nCONTENT;\n\nif ( $geolocation or $hostName ):\n$return .= <<<CONTENT\n\n\t\t<div class='ipsColumns ipsColumns_noSpacing ipsColumns_collapseTablet'>\n\t\t\t<div class='ipsColumn ipsColumn_wide ipsAreaBackground_light'>\n\t\t\t\t<div class='ipsPad cIPInfo_map'>\n\t\t\t\t\t\nCONTENT;\n\nif ( $hostName ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t<p>\nCONTENT;\n\n$sprintf = array($hostName); $return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ip_geolocation_hostname', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );\n$return .= <<<CONTENT\n<\/p>\n\t\t\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t\t\t\nCONTENT;\n\nif ( $geolocation ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\nCONTENT;\n\nif ( $map ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t{$map}\n\t\t\t\t\t\t\t<br>\n\t\t\t\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t<p>{$geolocation}<\/p>\n\t\t\t\t\t\t<p class=\"ipsType_light ipsType_small\"><i class=\"fa fa-info-circle\"><\/i> \nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'ip_geolocation_info', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/p>\n\t\t\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t\t<\/div>\n\t\t\t<\/div>\n\t\t\t<div class='ipsColumn ipsColumn_fluid'>\n\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t<div class=\"ipsGrid ipsGrid_collapsePhone ipsAreaBackground_reset\">\n\t\t\nCONTENT;\n\nforeach ( $counts as $key => $value ):\n$return .= <<<CONTENT\n\n\t\t\t\nCONTENT;\n\nif ( $value ):\n$return .= <<<CONTENT\n\n\t\t\t\t<div class='ipsGrid_span4 ipsPad ipsType_center'>\n\t\t\t\t\t<a href=\"\nCONTENT;\n$return .= htmlspecialchars( $url->setQueryString( 'area', $key ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" class=\"ipsType_blendLinks\">\n\t\t\t\t\t\t<span class='ipsType_veryLarge cIPInfo_value'>\nCONTENT;\n$return .= htmlspecialchars( $value, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n<\/span><br>\n\t\t\t\t\t\t<p class='ipsType_reset ipsTruncate ipsTruncate_line ipsType_minorHeading'>\nCONTENT;\n\n$val = \"ipAddresses__{$key}\"; $return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/p>\n\t\t\t\t\t<\/a>\n\t\t\t\t<\/div>\n\t\t\t\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\n\n\t\t\t\t<div class='ipsGrid_span4 ipsPad ipsType_center ipsType_light ipsFaded'>\n\t\t\t\t\t<span class='ipsType_veryLarge cIPInfo_value'>\nCONTENT;\n$return .= htmlspecialchars( $value, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n<\/span><br>\n\t\t\t\t\t<p class='ipsType_reset ipsTruncate ipsTruncate_line ipsType_minorHeading'>\nCONTENT;\n\n$val = \"ipAddresses__{$key}\"; $return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/p>\n\t\t\t\t<\/div>\n\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\nCONTENT;\n\nendforeach;\n$return .= <<<CONTENT\n\n\t<\/div>\n\t\nCONTENT;\n\nif ( $geolocation ):\n$return .= <<<CONTENT\n\n\t\t\t<\/div>\n\t\t<\/div>\n\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n<\/div>\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction messengerQuota( $member, $count ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n\nCONTENT;\n\nif ( $member->canAccessModule( \\IPS\\Application\\Module::get( 'core', 'messaging', 'front' ) ) AND $member->group['g_max_messages'] > 0 ):\n$return .= <<<CONTENT\n\n\t<div class='ipsGrid_span6 ipsResponsive_hidePhone'>\n\t\t<div class='ipsPos_right ipsType_right' data-role=\"quotaTooltip\" data-ipsTooltip data-ipsTooltip-label=\"\nCONTENT;\n\n$sprintf = array($member->group['g_max_messages']); $pluralize = array( $count ); $return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_quota', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf, 'pluralize' => $pluralize ) );\n$return .= <<<CONTENT\n\">\n\t\t\t\nCONTENT;\n\n$percent = floor( 100 \/ $member->group['g_max_messages'] * $count );\n$return .= <<<CONTENT\n\n\t\t\t<span class=\"ipsAttachment_progress\"><span data-role='quotaWidth' style='width: \nCONTENT;\n\n$return .= htmlspecialchars( $percent > 100 ? 100 : $percent, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n%'><\/span><\/span><br>\n\t\t\t<span class='ipsType_light ipsResponsive_hidePhone'>\nCONTENT;\n\n$sprintf = array($percent); $return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'messenger_quota_short', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );\n$return .= <<<CONTENT\n<\/span>\n\t\t<\/div>\n\t<\/div>\n\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction nameHistoryRows( $table, $headers, $rows ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n\nCONTENT;\n\nif ( \\count( $rows ) ):\n$return .= <<<CONTENT\n\n\t\nCONTENT;\n\nforeach ( $rows as $row ):\n$return .= <<<CONTENT\n\n\t\t<li class='ipsDataItem'>\n\t\t\t<div class=\"ipsDataItem_main ipsType_center\">\n\t\t   \t\t<h4 class='ipsType_minorHeading'>\nCONTENT;\n\n$val = ( $row['log_date'] instanceof \\IPS\\DateTime ) ? $row['log_date'] : \\IPS\\DateTime::ts( $row['log_date'] );$return .= $val->html();\n$return .= <<<CONTENT\n<\/h4>\n\t\t   \t\t<p class='ipsType_reset ipsType_large'>\n\t\t      \t\t\nCONTENT;\n$return .= htmlspecialchars( $row['log_data']['old'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n &nbsp;&nbsp;<i class='fa fa-angle-right'><\/i>&nbsp;&nbsp; \nCONTENT;\n$return .= htmlspecialchars( $row['log_data']['new'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\n\t\t      \t<\/p>\n\t\t   <\/div>\n\t\t<\/li>\n\t\nCONTENT;\n\nendforeach;\n$return .= <<<CONTENT\n\n\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction nameHistoryTable( $table, $headers, $rows, $quickSearch ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n\n<div data-role=\"tablePagination\" \nCONTENT;\n\nif ( $table->pages <= 1 ):\n$return .= <<<CONTENT\nclass='ipsHide'\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n>\n    \nCONTENT;\n\n$return .= \\IPS\\Theme::i()->getTemplate( \"global\", \"core\", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit, TRUE, $table->getPaginationKey() );\n$return .= <<<CONTENT\n\n<\/div>\n\n\nCONTENT;\n\nif ( \\count( $rows ) ):\n$return .= <<<CONTENT\n\n<ol class='ipsDataList ipsClear \nCONTENT;\n\nforeach ( $table->classes as $class ):\n$return .= <<<CONTENT\n\nCONTENT;\n$return .= htmlspecialchars( $class, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n \nCONTENT;\n\nendforeach;\n$return .= <<<CONTENT\n' id='elTable_\nCONTENT;\n$return .= htmlspecialchars( $table->uniqueId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' data-role=\"tableRows\">\n    \nCONTENT;\n\n$return .= $table->rowsTemplate[0]->{$table->rowsTemplate[1]}( $table, $headers, $rows );\n$return .= <<<CONTENT\n\n<\/ol>\n\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\n\n<div class='ipsType_center ipsPad'>\n    <p class='ipsType_large'>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_rows_in_table', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/p>\n<\/div>\n\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\n<div class=\"ipsButtonBar ipsPad_half ipsClearfix ipsClear \nCONTENT;\n\nif ( $table->pages <= 1 ):\n$return .= <<<CONTENT\nipsHide\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\" data-role=\"tablePagination\">\n    \nCONTENT;\n\n$return .= \\IPS\\Theme::i()->getTemplate( \"global\", \"core\", 'global' )->pagination( $table->baseUrl, $table->pages, $table->page, $table->limit, TRUE, $table->getPaginationKey() );\n$return .= <<<CONTENT\n\n<\/div>\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction notificationLabel( $key, $data ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n\nCONTENT;\n\nif ( $data['icon'] ):\n$return .= <<<CONTENT\n\n\t<i class=\"fa fa-\nCONTENT;\n$return .= htmlspecialchars( $data['icon'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\"><\/i>\n\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\nCONTENT;\n\n$val = \"{$key}\"; $return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction notificationsSettingsRow( $field, $details ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n<li class='ipsFieldRow ipsClearfix \nCONTENT;\n\nif ( $field->error ):\n$return .= <<<CONTENT\nipsFieldRow_error\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n' \nCONTENT;\n\nif ( $field->htmlId ):\n$return .= <<<CONTENT\nid=\"\nCONTENT;\n$return .= htmlspecialchars( $field->htmlId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\"\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n>\n\t\nCONTENT;\n\nif ( \\IPS\\Dispatcher::i()->controllerLocation === 'admin' or $details['showTitle'] ):\n$return .= <<<CONTENT\n\n\t\t<label class='ipsFieldRow_label ipsSpacer_bottom'>\n\t\t\t\nCONTENT;\n\n$val = \"{$details['title']}\"; $return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n\n\t\t<\/label>\n\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t<div class='ipsFieldRow_content'>\n\t\t\nCONTENT;\n\nif ( $details['description'] ):\n$return .= <<<CONTENT\n\n\t\t\t<div class='ipsType_normal ipsSpacer_bottom ipsSpacer_half'>\nCONTENT;\n\n$val = \"{$details['description']}\"; $return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/div>\n\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t<ul class=\"ipsField_fieldList\">\n\t\t\t\nCONTENT;\n\nif ( isset( $details['extra'] ) ):\n$return .= <<<CONTENT\n\n\t\t\t\t\nCONTENT;\n\nforeach ( $details['extra'] as $k => $option ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t<li class=\"ipsSpacer_bottom\">\n\t\t\t\t\t\t<span class='ipsCustomInput'>\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"\nCONTENT;\n$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n[\nCONTENT;\n$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n]\" value=\"1\" \nCONTENT;\n\nif ( $option['value'] ):\n$return .= <<<CONTENT\nchecked\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n id=\"elCheckbox_\nCONTENT;\n$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n_\nCONTENT;\n$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\">\n\t\t\t\t\t\t\t<span><\/span>\n\t\t\t\t\t\t<\/span>\n\t\t\t\t\t\t<div class='ipsField_fieldList_content'>\n\t\t\t\t\t\t\t<label for='elCheckbox_\nCONTENT;\n$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n_\nCONTENT;\n$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' id='elField_\nCONTENT;\n$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n_label'>\nCONTENT;\n\n$val = \"{$option['title']}\"; $return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/label>\n\t\t\t\t\t\t\t\nCONTENT;\n\nif ( isset( $option['description'] ) ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t\t<br>\n\t\t\t\t\t\t\t\t<span class='ipsFieldRow_desc'>\nCONTENT;\n\n$val = \"{$option['description']}\"; $return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/span>\n\t\t\t\t\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t<\/div>\n\t\t\t\t\t<\/li>\n\t\t\t\t\nCONTENT;\n\nendforeach;\n$return .= <<<CONTENT\n\n\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t\nCONTENT;\n\nforeach ( $details['options'] as $k => $option ):\n$return .= <<<CONTENT\n\n\t\t\t\t\nCONTENT;\n\nif ( $k === 'inline' and isset( $details['options']['push'] ) ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t<li class=\"ipsSpacer_bottom\">\n\t\t\t\t\t\t<ul class=\"ipsField_fieldList \" role=\"radiogroup\">\n\t\t\t\t\t\t\t<li>\n\t\t\t\t\t\t\t\t<span class='ipsCustomInput'>\n\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"\nCONTENT;\n$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n[\nCONTENT;\n$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n]\" value=\"push\" \nCONTENT;\n\nif ( $details['options']['push']['value'] ):\n$return .= <<<CONTENT\nchecked\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n id=\"elCheckbox_\nCONTENT;\n$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n_\nCONTENT;\n$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n_push\" \nCONTENT;\n\nif ( !$option['editable'] ):\n$return .= <<<CONTENT\ndisabled\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n>\n\t\t\t\t\t\t\t\t\t<span><\/span>\n\t\t\t\t\t\t\t\t<\/span>\n\t\t\t\t\t\t\t\t<div class='ipsField_fieldList_content ipsType_break'>\n\t\t\t\t\t\t\t\t\t<label for=\"elCheckbox_\nCONTENT;\n$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n_\nCONTENT;\n$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n_push\">\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'notifications_list_and_app', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/label>\n\t\t\t\t\t\t\t\t<\/div>\n\t\t\t\t\t\t\t<\/li>\n\t\t\t\t\t\t\t<li>\n\t\t\t\t\t\t\t\t<span class='ipsCustomInput'>\n\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"\nCONTENT;\n$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n[\nCONTENT;\n$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n]\" value=\"inline\" \nCONTENT;\n\nif ( $details['options']['inline']['value'] and !$details['options']['push']['value'] ):\n$return .= <<<CONTENT\nchecked\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n id=\"elCheckbox_\nCONTENT;\n$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n_\nCONTENT;\n$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n_inline\" \nCONTENT;\n\nif ( !$option['editable'] ):\n$return .= <<<CONTENT\ndisabled\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n>\n\t\t\t\t\t\t\t\t\t<span><\/span>\n\t\t\t\t\t\t\t\t<\/span>\n\t\t\t\t\t\t\t\t<div class='ipsField_fieldList_content ipsType_break'>\n\t\t\t\t\t\t\t\t\t<label for=\"elCheckbox_\nCONTENT;\n$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n_\nCONTENT;\n$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n_inline\">\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'notifications_list_only', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/label>\n\t\t\t\t\t\t\t\t<\/div>\n\t\t\t\t\t\t\t<\/li>\n\t\t\t\t\t\t\t<li>\n\t\t\t\t\t\t\t\t<span class='ipsCustomInput'>\n\t\t\t\t\t\t\t\t\t<input type=\"radio\" name=\"\nCONTENT;\n$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n[\nCONTENT;\n$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n]\" value=\"\" \nCONTENT;\n\nif ( !$details['options']['inline']['value'] and !$details['options']['push']['value'] ):\n$return .= <<<CONTENT\nchecked\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n id=\"elCheckbox_\nCONTENT;\n$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n_\nCONTENT;\n$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n_off\" \nCONTENT;\n\nif ( !$option['editable'] ):\n$return .= <<<CONTENT\ndisabled\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n>\n\t\t\t\t\t\t\t\t\t<span><\/span>\n\t\t\t\t\t\t\t\t<\/span>\n\t\t\t\t\t\t\t\t<div class='ipsField_fieldList_content ipsType_break'>\n\t\t\t\t\t\t\t\t\t<label for=\"elCheckbox_\nCONTENT;\n$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n_\nCONTENT;\n$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n_off\">\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'notifications_no_list', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/label>\n\t\t\t\t\t\t\t\t<\/div>\n\t\t\t\t\t\t\t<\/li>\n\t\t\t\t\t\t<\/ul>\n\t\t\t\t\t<\/li>\n\t\t\t\t\nCONTENT;\n\nelseif ( $k !== 'push' or !isset( $details['options']['inline'] ) ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t<li class=\"ipsSpacer_bottom\">\n\t\t\t\t\t\t<span class='ipsCustomInput'>\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"\nCONTENT;\n$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n[\nCONTENT;\n$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n]\" value=\"1\" \nCONTENT;\n\nif ( $option['value'] ):\n$return .= <<<CONTENT\nchecked\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n id=\"elCheckbox_\nCONTENT;\n$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n_\nCONTENT;\n$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" \nCONTENT;\n\nif ( !$option['editable'] ):\n$return .= <<<CONTENT\ndisabled\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n>\n\t\t\t\t\t\t\t<span><\/span>\n\t\t\t\t\t\t<\/span>\n\t\t\t\t\t\t<div class='ipsField_fieldList_content'>\n\t\t\t\t\t\t\t<label for='elCheckbox_\nCONTENT;\n$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n_\nCONTENT;\n$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' id='elField_\nCONTENT;\n$return .= htmlspecialchars( $field->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n_label'>\nCONTENT;\n\n$val = \"{$option['title']}\"; $return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/label>\n\t\t\t\t\t\t<\/div>\n\t\t\t\t\t<\/li>\n\t\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t\nCONTENT;\n\nendforeach;\n$return .= <<<CONTENT\n\n\t\t<\/ul>\n\t<\/div>\n<\/li>\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction photoCrop( $name, $value, $photo ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n\n<div data-controller='core.global.core.cropper' id='elPhotoCropper' class='ipsAreaBackground_light ipsType_center ipsPad'>\n\t<h3 class='ipsType_sectionHead'>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'photo_crop_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/h3>\n\t<p class='ipsType_light ipsType_reset'>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'photo_crop_instructions', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/p>\n\t<br>\n\n\t<div class='ipsForm_cropper'>\n\t\t<div data-role='cropper'>\n\t\t\t<img src=\"\nCONTENT;\n$return .= htmlspecialchars( $photo, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" data-role='profilePhoto'>\n\t\t<\/div>\n\t<\/div>\n\n\t<input type='hidden' name='\nCONTENT;\n$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n[0]' value='\nCONTENT;\n$return .= htmlspecialchars( $value[0], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' data-role='topLeftX'>\n\t<input type='hidden' name='\nCONTENT;\n$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n[1]' value='\nCONTENT;\n$return .= htmlspecialchars( $value[1], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' data-role='topLeftY'>\n\t<input type='hidden' name='\nCONTENT;\n$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n[2]' value='\nCONTENT;\n$return .= htmlspecialchars( $value[2], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' data-role='bottomRightX'>\n\t<input type='hidden' name='\nCONTENT;\n$return .= htmlspecialchars( $name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n[3]' value='\nCONTENT;\n$return .= htmlspecialchars( $value[3], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' data-role='bottomRightY'>\n<\/div>\nCONTENT;\n\n\t\treturn $return;\n}}"
VALUE;
