<?php

return <<<'VALUE'
"namespace IPS\\Theme;\nclass class_cms_database_category_index\n{\n\tfunction categoryRow( $category ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n\nCONTENT;\n\n$RecordsClass = $category::$contentItemClass;\n$return .= <<<CONTENT\n\n\nCONTENT;\n\nif ( $category->can('view') ):\n$return .= <<<CONTENT\n\n\nCONTENT;\n\n$lastPost = $category->lastPost();\n$return .= <<<CONTENT\n\n\t<li class=\"ipsDataItem ipsDataItem_responsivePhoto \nCONTENT;\n\nif ( $RecordsClass::containerUnread( $category ) ):\n$return .= <<<CONTENT\nipsDataItem_unread\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n ipsClearfix\" data-categoryID=\"\nCONTENT;\n$return .= htmlspecialchars( $category->_id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\">\n\t\t<div class=\"ipsDataItem_icon ipsDataItem_category\">\n\t\t\t\nCONTENT;\n\nif ( \\IPS\\Member::loggedIn()->member_id ):\n$return .= <<<CONTENT\n<a href=\"\nCONTENT;\n$return .= htmlspecialchars( $category->url()->setQueryString( array( 'do' => 'markRead', 'c' => $category->_id ) )->csrf(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" data-action='markAsRead'>\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t\t<span class='ipsItemStatus ipsItemStatus_large \nCONTENT;\n\nif ( !$RecordsClass::containerUnread( $category ) ):\n$return .= <<<CONTENT\nipsItemStatus_read\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n'>\n\t\t\t\t\t<i class=\"fa fa-comments\"><\/i>\n\t\t\t\t<\/span>\n\t\t\t\nCONTENT;\n\nif ( \\IPS\\Member::loggedIn()->member_id ):\n$return .= <<<CONTENT\n<\/a>\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t<\/div>\n\t\t<div class=\"ipsDataItem_main ipsPos_middle\">\n\t\t\t<h4 class=\"ipsDataItem_title\">\n\t\t\t\t<a href=\"\nCONTENT;\n$return .= htmlspecialchars( $category->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\">\nCONTENT;\n$return .= htmlspecialchars( $category->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n<\/a>\n\t\t\t<\/h4>\n\t\t\t\nCONTENT;\n\nif ( $category->hasChildren() ):\n$return .= <<<CONTENT\n\n\t\t\t\t<ul class=\"ipsDataItem_subList ipsList_inline\">\n\t\t\t\t\t\nCONTENT;\n\nforeach ( $category->children() as $subCategory ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t<li class=\"\nCONTENT;\n\nif ( $RecordsClass::containerUnread( $subCategory ) ):\n$return .= <<<CONTENT\nipsDataItem_unread\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\">\n\t\t\t\t\t\t\t<a href=\"\nCONTENT;\n$return .= htmlspecialchars( $subCategory->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\">\nCONTENT;\n$return .= htmlspecialchars( $subCategory->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n<\/a>\n\t\t\t\t\t\t<\/li>\n\t\t\t\t\t\nCONTENT;\n\nendforeach;\n$return .= <<<CONTENT\n\n\t\t\t\t<\/ul>\n\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t\nCONTENT;\n\nif ( $category->_description ):\n$return .= <<<CONTENT\n\n\t\t\t\t<div class=\"ipsDataItem_meta ipsType_richText\">{$category->_description}<\/div>\n\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t<\/div>\n\t\t\nCONTENT;\n\nif ( $lastPost ):\n$return .= <<<CONTENT\n\n\t\t\t<dl class=\"ipsDataItem_stats ipsDataItem_statsLarge\">\n\t\t\t\t\nCONTENT;\n\n$count = $RecordsClass::contentCount( $category, FALSE );\n$return .= <<<CONTENT\n\n\t\t\t\t<dt class=\"ipsDataItem_stats_number\">\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->formatNumber( $count );\n$return .= <<<CONTENT\n<\/dt>\n\t\t\t\t<dd class=\"ipsDataItem_stats_type ipsType_light\">\nCONTENT;\n\n$return .= htmlspecialchars( \\IPS\\cms\\Databases::load( $category->database_id )->recordWord( $count ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n<\/dd>\n\t\t\t<\/dl>\n\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t<ul class=\"ipsDataItem_lastPoster ipsDataItem_withPhoto\">\n\t\t\t\nCONTENT;\n\nif ( $lastPost ):\n$return .= <<<CONTENT\n\n\t\t\t\t<li>\nCONTENT;\n\n$return .= \\IPS\\cms\\_Theme::i()->getTemplate( \"global\", \"core\" )->userPhoto( $lastPost['author'], 'tiny' );\n$return .= <<<CONTENT\n<\/li>\n\t\t\t\t<li><div class='ipsType_break ipsContained'><a href=\"\nCONTENT;\n$return .= htmlspecialchars( $lastPost['record_url'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" class='ipsTruncate ipsTruncate_line' title='\nCONTENT;\n$return .= htmlspecialchars( $lastPost['record_title'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n'>\nCONTENT;\n$return .= htmlspecialchars( $lastPost['record_title'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n<\/a><\/div><\/li>\n\t\t\t\t<li class='ipsType_blendLinks'>\nCONTENT;\n\n$htmlsprintf = array($lastPost['author']->link()); $return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'byline_nodate', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'htmlsprintf' => $htmlsprintf ) );\n$return .= <<<CONTENT\n<\/li>\n\t\t\t\t<li data-short=\"1 dy\" class=\"ipsType_light\"><a href='\nCONTENT;\n$return .= htmlspecialchars( $lastPost['record_url']->setQueryString( 'do', 'getLastComment' ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' title='\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'get_last_post', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n' class='ipsType_blendLinks'>\nCONTENT;\n\n$val = ( $lastPost['date'] instanceof \\IPS\\DateTime ) ? $lastPost['date'] : \\IPS\\DateTime::ts( $lastPost['date'] );$return .= $val->html();\n$return .= <<<CONTENT\n<\/a><\/li>\n\t\t\t\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\n\n\t\t\t\t<li class='ipsType_light ipsResponsive_showDesktop'>\nCONTENT;\n\n$sprintf = array(\\IPS\\cms\\Databases::load( $category->database_id )->recordWord()); $return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'content_categories_index_no_records', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );\n$return .= <<<CONTENT\n<\/li>\n\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t<\/ul>\n\t<\/li>\n\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction index( $database, $categories, $url ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n<div class='ipsPageHeader ipsClearfix ipsSpacer_bottom'>\n\t\nCONTENT;\n\nif ( $database->cat_index_type == 1 ):\n$return .= <<<CONTENT\n\n\t\t<div class='ipsPos_right ipsResponsive_noFloat'>\n\t\t\t<a href=\"\nCONTENT;\n$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" class=\"ipsButton ipsButton_medium ipsButton_fullWidth ipsButton_link\"><i class=\"fa fa-star\"><\/i> \nCONTENT;\n\n$sprintf = array($database->recordWord()); $return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cms_show_featured', ENT_DISALLOWED, 'UTF-8', FALSE ), FALSE, array( 'sprintf' => $sprintf ) );\n$return .= <<<CONTENT\n<\/a>\n\t\t<\/div>\n\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t<h1 class='ipsType_pageTitle'>\nCONTENT;\n$return .= htmlspecialchars( $database->_title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n<\/h1>\n\t\nCONTENT;\n\nif ( $database->_description ):\n$return .= <<<CONTENT\n\n\t\t<div class='ipsType_richText ipsType_normal'>\n\t\t\t\nCONTENT;\n$return .= htmlspecialchars( $database->_description, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\n\t\t<\/div>\n\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n<\/div>\n<section class=\"ipsBox ipsResponsive_pull\">\n\t<ol class='ipsList_reset cCmsDatabase_index' data-controller='core.global.core.table, forums.front.forum.forumList' data-baseURL=''>\n\t\t<li class='cForumRow'>\n\t\t\t<h2 class=\"ipsType_sectionTitle ipsType_reset ipsType_blendLinks\">\n\t\t\t\t\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'content_categories_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n\n\t\t\t<\/h2>\n\t\t\t\nCONTENT;\n\nif ( ! \\count($categories) ):\n$return .= <<<CONTENT\n\n\t\t\t\t<div class=\"ipsBox ipsPad\">\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cms_no_cats_to_show', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/div>\n\t\t\t\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\n\n\t\t\t\t<ol class=\"ipsDataList ipsDataList_large ipsDataList_zebra\">\n\t\t\t\t\t\nCONTENT;\n\nforeach ( $categories as $category ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\nCONTENT;\n\n$return .= \\IPS\\cms\\_Theme::i()->getTemplate( \"category_index\", \"cms\", 'database' )->categoryRow( $category );\n$return .= <<<CONTENT\n\n\t\t\t\t\t\nCONTENT;\n\nendforeach;\n$return .= <<<CONTENT\n\n\t\t\t\t<\/ol>\n\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t<\/li>\n\t<\/ol>\n<\/section>\nCONTENT;\n\n\t\treturn $return;\n}}"
VALUE;
