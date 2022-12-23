<?php

return <<<'VALUE'
"namespace IPS\\Theme;\nclass class_cms_admin_media extends \\IPS\\Theme\\Template\n{\n\tpublic $cache_key = '8d061c0d560298a502488f932dbeb89a';\n\tfunction fileListing( $url, $item ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n\n\nCONTENT;\n\nif ( $item instanceof \\IPS\\cms\\Media ):\n$return .= <<<CONTENT\n\n\t<li class='ipsGrid_span4' data-role='mediaItem' data-fileid='\nCONTENT;\n$return .= htmlspecialchars( $item->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' data-uploaded='\nCONTENT;\n\n$val = ( $item->added instanceof \\IPS\\DateTime ) ? $item->added : \\IPS\\DateTime::ts( $item->added );$return .= (string) $val->localeDate();\n$return .= <<<CONTENT\n' data-path='\nCONTENT;\n$return .= htmlspecialchars( $item->full_path, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' data-filename='\nCONTENT;\n$return .= htmlspecialchars( $item->filename, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' data-url='\nCONTENT;\n$return .= htmlspecialchars( $item->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n?_cb=\nCONTENT;\n\n$return .= htmlspecialchars( time(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' data-fileType='\nCONTENT;\n\nif ( $item->is_image ):\n$return .= <<<CONTENT\nimage\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\nfile\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n'>\n\t\t<div class='cMedia_item \nCONTENT;\n\nif ( $item->is_image ):\n$return .= <<<CONTENT\ncMedia_itemImage\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n'>\n\t\t\t<div class='ipsAreaBackground_light'>\n\t\t\t\t\nCONTENT;\n\nif ( $item->is_image ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t<img src='\nCONTENT;\n$return .= htmlspecialchars( $item->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n?_cb=\nCONTENT;\n\n$return .= htmlspecialchars( time(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n'>\n\t\t\t\t\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\n\n\t\t\t\t\t<div class='ipsNoThumb'><\/div>\n\t\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t<\/div>\n\t\t\t<p class='cMedia_filename ipsType_reset ipsTruncate ipsTruncate_line'>\nCONTENT;\n$return .= htmlspecialchars( $item->filename, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n<\/p>\n\t\t<\/div>\n\t<\/li>\n\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction folderRow( $url, $row ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n\n\nCONTENT;\n\nif ( !( $row instanceof \\IPS\\cms\\Media ) ):\n$return .= <<<CONTENT\n\n\t<li class='ipsTreeList_inactiveBranch' data-role=\"mediaFolder\" data-folderID='\nCONTENT;\n$return .= htmlspecialchars( $row->id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n'>\n\t\t<a href='\nCONTENT;\n$return .= htmlspecialchars( $url->setQueryString( array( 'root' => $row->id ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n'>\nCONTENT;\n$return .= htmlspecialchars( $row->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n<\/a>\n\t\t<ul><\/ul>\t\t\t\t\n\t<\/li>\n\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction media( $tree ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n\n\nCONTENT;\n\n$rootButtons = \\call_user_func( $tree->getRootButtons );\n$return .= <<<CONTENT\n\n\n<div data-controller='cms.admin.media.main' class='cMedia_manager'>\n\t<div class='ipsColumns ipsColumns_collapsePhone'>\n\t\t<div class='ipsColumn ipsColumn_wide'>\n\t\t\t<div class='cMedia_managerToolbar'>\n\t\t\t\t\nCONTENT;\n\nif ( $rootButtons['add_folder'] ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t<a href='\nCONTENT;\n$return .= htmlspecialchars( $rootButtons['add_folder']['link'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' data-ipsDialog data-ipsDialog-title='\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cms_add_media_folder', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n' class='ipsButton ipsButton_normal ipsButton_small ipsButton_fullWidth' data-role='folderButton'><i class='fa fa-plus'><\/i> \nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cms_add_media_folder', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/a>\n\t\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t<\/div>\n\t\t\t<div class=\"ipsTabs ipsTabs_stretch ipsClearfix acpFormTabBar\" id=\"elMedia_sidebarTabs\" data-ipsTabBar data-ipsTabBar-contentarea=\"#elMedia_sidebar\" data-ipstabbar-updateurl=\"false\">\n\t\t\t\t<a href=\"#elMedia_sidebarTabs\" data-action=\"expandTabs\"><i class=\"fa fa-caret-down\"><\/i><\/a>\n\t\t\t\t<ul role='tablist'>\n\t\t\t\t\t<li>\n\t\t\t\t\t\t<a href=\"#\" class=\"ipsTabs_item ipsTabs_activeItem\" data-type=\"templates\" id=\"elTab_folders\" aria-selected=\"true\">\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'media_folders', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/a>\n\t\t\t\t\t<\/li>\n\t\t\t\t\t<li>\n\t\t\t\t\t\t<a href=\"#\" class=\"ipsTabs_item ipsTabs_itemDisabled\" id='elTab_overview' data-type=\"css\">\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'media_file_overview', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/a>\n\t\t\t\t\t<\/li>\n\t\t\t\t<\/ul>\n\t\t\t<\/div>\n\t\t\t<div id='elMedia_sidebar' class='ipsAreaBackground_reset ipsScrollbar'>\n\t\t\t\t<div id='ipsTabs_elMedia_sidebarTabs_elTab_folders_panel' class='ipsTabs_panel'>\n\t\t\t\t\t\nCONTENT;\n\n$roots = \\call_user_func( $tree->getRoots );\n$return .= <<<CONTENT\n\n\t\t\t\t\t<ul class='ipsTreeList' data-role='folderList'>\n\t\t\t\t\t\t<li class='ipsTreeList_activeBranch ipsTreeList_activeNode' data-role=\"mediaFolder\" data-folderID='0' data-loaded='true'>\n\t\t\t\t\t\t\t<a href='\nCONTENT;\n$return .= htmlspecialchars( $tree->url->setQueryString( array('root' => 0 ) ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n'>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'media_root_folder', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/a>\n\t\t\t\t\t\t\t<ul>\n\t\t\t\t\t\t\t\t\nCONTENT;\n\nforeach ( $roots as $id => $row ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t\t\t\nCONTENT;\n\n$return .= \\IPS\\Theme::i()->getTemplate( \"media\", \"cms\" )->folderRow( $tree->url, $row );\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t\t\nCONTENT;\n\nendforeach;\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t<\/ul>\n\t\t\t\t\t\t<\/li>\n\t\t\t\t\t<\/ul>\n\t\t\t\t<\/div>\n\t\t\t\t<div id='ipsTabs_elMedia_sidebarTabs_elTab_overview_panel' class='ipsTabs_panel ipsPad' data-role='mediaSidebar'>\n\t\t\t\t\t<div data-role='itemInformation'>\n\t\t\t\t\t\t<div class='ipsAreaBackground_light cMedia_preview ipsType_center' data-role='itemPreview'><\/div>\n\n\t\t\t\t\t\t<div class='ipsSpacer_top'>\n\t\t\t\t\t\t\t<strong class='ipsType_minorHeading'>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'media_tag_title', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/strong>\n\t\t\t\t\t\t\t<input type='text' class='ipsField_fullWidth' value='' data-role='itemTag'>\n\t\t\t\t\t\t\t<p class='ipsType_small ipsType_light'>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'media_tag_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/p>\n\t\t\t\t\t\t<\/div>\n\t\t\t\t\t\t\n\t\t\t\t\t\t<hr class='ipsHr'>\n\n\t\t\t\t\t\t<ul class='ipsList_reset ipsSpacer_top'>\n\t\t\t\t\t\t\t<li class='ipsSpacer_bottom ipsSpacer_half'>\n\t\t\t\t\t\t\t\t<h3 class='ipsType_minorHeading'>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'media_filename', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/h3>\n\t\t\t\t\t\t\t\t<p class='ipsType_reset ipsType_medium ipsType_break' data-role='itemFilename'><\/p>\n\t\t\t\t\t\t\t<\/li>\n\t\t\t\t\t\t\t<li class='ipsSpacer_bottom ipsSpacer_half'>\n\t\t\t\t\t\t\t\t<h3 class='ipsType_minorHeading'>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'media_uploaded', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/h3>\n\t\t\t\t\t\t\t\t<p class='ipsType_reset ipsType_medium' data-role='itemUploaded'><\/p>\n\t\t\t\t\t\t\t<\/li>\n\t\t\t\t\t\t\t<li class='ipsSpacer_bottom ipsSpacer_half'>\n\t\t\t\t\t\t\t\t<h3 class='ipsType_minorHeading'>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'media_size', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/h3>\n\t\t\t\t\t\t\t\t<p class='ipsType_reset ipsType_medium' data-role='itemFilesize'><\/p>\n\t\t\t\t\t\t\t<\/li>\n\t\t\t\t\t\t\t<li class='ipsSpacer_bottom ipsSpacer_half' data-role='itemDimensionsRow'>\n\t\t\t\t\t\t\t\t<h3 class='ipsType_minorHeading'>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'media_dims', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/h3>\n\t\t\t\t\t\t\t\t<p class='ipsType_reset ipsType_medium' data-role='itemDimensions'><\/p>\n\t\t\t\t\t\t\t<\/li>\n\t\t\t\t\t\t<\/ul>\n\n\t\t\t\t\t\t<hr class='ipsHr'>\n\n\t\t\t\t\t\t<div class='ipsSpacer_top'>\n\t\t\t\t\t\t\t<a href='#' class='ipsType_medium' data-role='replaceFile' data-baseUrl=\"\nCONTENT;\n\n$return .= htmlspecialchars( \\IPS\\Http\\Url::internal( \"app=cms&module=pages&controller=media&do=replace&id=\", null, \"\", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );\n$return .= <<<CONTENT\n\">\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'replace_media_file', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/a>\n\t\t\t\t\t\t<\/div>\n\t\t\t\t\t<\/div>\n\t\t\t\t\t<div data-role='multipleItems'>\n\t\t\t\t\t\t<div class='ipsPad ipsType_large ipsType_light ipsType_center ipsSpacer_top ipsSpacer_double' data-role='multipleItemsMessage'><\/div>\n\t\t\t\t\t<\/div>\n\t\t\t\t<\/div>\n\t\t\t<\/div>\t\t\t\n\t\t<\/div>\n\t\t<div class='ipsColumn ipsColumn_fluid'>\n\t\t\t<div class='cMedia_managerToolbar'>\n\t\t\t\t<ul class='ipsToolList ipsToolList_horizontal'>\n\t\t\t\t\t\nCONTENT;\n\nif ( $rootButtons['add_page'] ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t<li class='ipsPos_left'><a href='\nCONTENT;\n\n$return .= htmlspecialchars( \\IPS\\Http\\Url::internal( \"app=cms&module=pages&controller=media&do=upload\", null, \"\", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );\n$return .= <<<CONTENT\n' data-ipsDialog data-ipsDialog-forceReload data-ipsDialog-remoteSubmit data-ipsDialog-title='\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cms_add_media', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n' class='ipsButton ipsButton_primary ipsButton_small ipsButton_fullWidth' data-role='uploadButton'><i class='fa fa-cloud-upload'><\/i> &nbsp;\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cms_add_media', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/a><\/li>\n\t\t\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t\t\t<li class='ipsPos_left ipsHide' data-action='deleteFolder'><a href='\nCONTENT;\n\n$return .= htmlspecialchars( \\IPS\\Http\\Url::internal( \"app=cms&module=pages&controller=media&do=delete\", null, \"\", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );\n$return .= <<<CONTENT\n' data-ipsDialog data-ipsDialog-forceReload data-ipsDialog-remoteVerify=\"false\" data-ipsDialog-title='\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'delete', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n' class='ipsButton ipsButton_negative ipsButton_small ipsButton_fullWidth'><i class='fa fa-times'><\/i> \nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cms_delete_folder_media', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/a><\/li>\n\t\t\t\t\t<li class='ipsPos_left ipsHide' data-action='deleteSelected'><a href='#' class='ipsButton ipsButton_negative ipsButton_small ipsButton_fullWidth'><i class='fa fa-times'><\/i> \nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cms_delete_selected_media', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/a><\/li>\n\t\t\t\t\t<li class='ipsResponsive_showPhone ipsResponsive_block'><hr class='ipsHr'><\/li>\n\t\t\t\t\t<li class='ipsPos_right'>\n\t\t\t\t\t\t<input type='search' class='' data-role='mediaSearch' id='elMedia_searchField' placeholder='\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cms_search_media', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n'>\n\t\t\t\t\t<\/li>\n\t\t\t\t<\/ul>\n\t\t\t<\/div>\n\t\t\t<div class='ipsPad ipsAreaBackground_reset ipsScrollbar' data-role=\"fileListing\" id='elMedia_fileList' data-showing='root'>\n\t\t\t\t<ul class='ipsGrid' data-ipsGrid data-ipsGrid-minItemSize='100' data-ipsGrid-maxItemSize='200'>\n\t\t\t\t\t\nCONTENT;\n\nforeach ( $roots as $id => $data ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\nCONTENT;\n\n$return .= \\IPS\\Theme::i()->getTemplate( \"media\", \"cms\" )->fileListing( $tree->url, $data );\n$return .= <<<CONTENT\n\n\t\t\t\t\t\nCONTENT;\n\nendforeach;\n$return .= <<<CONTENT\n\n\t\t\t\t<\/ul>\n\t\t\t<\/div>\n\t\t\t<div class='ipsPad ipsAreaBackground_reset ipsScrollbar ipsHide' data-role=\"searchResults\" id='elMedia_searchResults'><\/div>\n\t\t<\/div>\n\t<\/div>\n<\/div>\nCONTENT;\n\n\t\treturn $return;\n}}"
VALUE;