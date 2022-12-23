<?php

return <<<'VALUE'
"namespace IPS\\Theme;\nclass class_cms_admin_records extends \\IPS\\Theme\\Template\n{\n\tpublic $cache_key = '1f7c77872e62046974ceb9e7f69f207b';\n\tfunction category( $category ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n\nCONTENT;\n\nif ( $parent = $category->parent() ):\n$return .= <<<CONTENT\n\n\t\nCONTENT;\n\n$databaseId = \\IPS\\Request::i()->database_id;\n$return .= <<<CONTENT\n\n\t<a href=\"#\" data-ipsHover-timeout=\"0.1\" data-ipsHover-target=\"\nCONTENT;\n\n$return .= htmlspecialchars( \\IPS\\Http\\Url::internal( \"app=cms&module=databases&controller=records&do=categoryTree&id={$category->_id}&database_id={$databaseId}\", null, \"\", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );\n$return .= <<<CONTENT\n\" data-ipsHover class=\"ipsType_light\">\nCONTENT;\n$return .= htmlspecialchars( $parent->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n<\/a> <i class=\"ipsType_light fa fa-angle-right\"><\/i>\n\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\nCONTENT;\n$return .= htmlspecialchars( $category->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction categorySelector( $form ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n\n<div class='ipsPad'>\n\t{$form}\n<\/div>\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction categoryTree( $category, $parents ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n<div class=\"ipsPad\">\n\nCONTENT;\n\n$databaseId = \\IPS\\Request::i()->database_id;\n$return .= <<<CONTENT\n\n\nCONTENT;\n\nforeach ( $parents as $cat ):\n$return .= <<<CONTENT\n\n\t<a href=\"\nCONTENT;\n\n$return .= htmlspecialchars( \\IPS\\Http\\Url::internal( \"app=cms&module=databases&controller=categories&do=form&id={$cat->_id}&database_id={$databaseId}\", null, \"\", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );\n$return .= <<<CONTENT\n\" class=\"ipsType_light\">\nCONTENT;\n$return .= htmlspecialchars( $cat->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n<\/a> <i class=\"ipsType_light fa fa-angle-right\"><\/i>\n\nCONTENT;\n\nendforeach;\n$return .= <<<CONTENT\n\n<a href=\"\nCONTENT;\n\n$return .= htmlspecialchars( \\IPS\\Http\\Url::internal( \"app=cms&module=databases&controller=categories&do=form&id={$category->_id}&database_id={$databaseId}\", null, \"\", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );\n$return .= <<<CONTENT\n\">\nCONTENT;\n$return .= htmlspecialchars( $category->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n<\/a>\n<\/div>\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction title( $row, $title ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n\nCONTENT;\n\nif ( $row['record_future_date'] or $row['record_approved'] === -1 or $row['record_approved'] === 0 or $row['record_pinned'] === 1 or $row['record_featured'] === 1 ):\n$return .= <<<CONTENT\n\n\t<span class='ipsPos_right'>\n\t\nCONTENT;\n\nif ( $row['record_future_date'] ):\n$return .= <<<CONTENT\n\n\t\t\nCONTENT;\n\n$time  = \\IPS\\DateTime::ts( $row['record_publish_date'] );\n$return .= <<<CONTENT\n\n\t\t<span class=\"ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_warning\" data-ipsTooltip title='\nCONTENT;\n\n$sprintf = array($time->localeDate(), $time->localeTime()); $return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'content_future_date_blurb', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );\n$return .= <<<CONTENT\n'><i class='fa fa-clock-o'><\/i><\/span>\n\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\nCONTENT;\n\nif ( $row['record_approved'] === -1 ):\n$return .= <<<CONTENT\n\n\t\t<span class=\"ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_warning\"><i class='fa fa-eye-slash'><\/i><\/span>\n\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\nCONTENT;\n\nif ( $row['record_approved'] === 0 ):\n$return .= <<<CONTENT\n\n\t\t<span class=\"ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_warning\" data-ipsTooltip><i class='fa fa-warning'><\/i><\/span>\n\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\nCONTENT;\n\nif ( $row['record_pinned'] === 1 ):\n$return .= <<<CONTENT\n\n\t\t<span class=\"ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_positive\" data-ipsTooltip title='\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'pinned', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n'><i class='fa fa-thumb-tack'><\/i><\/span>\n\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\nCONTENT;\n\nif ( $row['record_featured'] === 1 ):\n$return .= <<<CONTENT\n\n\t\t<span class=\"ipsBadge ipsBadge_icon ipsBadge_small ipsBadge_positive\" data-ipsTooltip title='\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'featured', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n'><i class='fa fa-star'><\/i><\/span>\n\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t<\/span>\n\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\nCONTENT;\n$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\nCONTENT;\n\n\t\treturn $return;\n}}"
VALUE;
