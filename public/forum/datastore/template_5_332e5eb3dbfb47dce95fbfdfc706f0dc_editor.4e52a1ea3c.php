<?php

return <<<'VALUE'
"namespace IPS\\Theme;\nclass class_core_global_editor extends \\IPS\\Theme\\Template\n{\n\tpublic $cache_key = '09b1a41bbf9d26c23c910cbce97da48f';\n\tfunction attachedAudio( $realUrl, $linkUrl, $title, $mimeType, $id ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n<audio controls src=\"<fileStore.core_Attachment>\/\nCONTENT;\n$return .= htmlspecialchars( $realUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" type=\"\nCONTENT;\n$return .= htmlspecialchars( $mimeType, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" data-fileid=\"\nCONTENT;\n$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" data-controller=\"core.global.core.embeddedaudio\">\n    <a class=\"ipsAttachLink\" href=\"\nCONTENT;\n$return .= htmlspecialchars( $linkUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\">\nCONTENT;\n$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n<\/a>\n<\/audio>\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction attachedFile( $url, $title, $pTag=TRUE, $ext='', $fileId='', $fileKey='' ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n\nCONTENT;\n\nif ( $pTag ):\n$return .= <<<CONTENT\n<p>\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n<a class=\"ipsAttachLink\" href=\"\nCONTENT;\n$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" data-fileExt='\nCONTENT;\n$return .= htmlspecialchars( $ext, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' \nCONTENT;\n\nif ( $fileId ):\n$return .= <<<CONTENT\ndata-fileid='\nCONTENT;\n$return .= htmlspecialchars( $fileId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n'\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n \nCONTENT;\n\nif ( $fileKey ):\n$return .= <<<CONTENT\ndata-filekey='\nCONTENT;\n$return .= htmlspecialchars( $fileKey, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n'\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n>\nCONTENT;\n$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n<\/a>\nCONTENT;\n\nif ( $pTag ):\n$return .= <<<CONTENT\n<\/p>\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction attachedImage( $url, $thumbnail, $title, $id, $width, $ratio=1 ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n<p><a href=\"<fileStore.core_Attachment>\/\nCONTENT;\n$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" class=\"ipsAttachLink ipsAttachLink_image\"><img data-fileid=\"\nCONTENT;\n$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" \nCONTENT;\n\nif ( \\IPS\\Settings::i()->lazy_load_enabled ):\n$return .= <<<CONTENT\nsrc=\"\nCONTENT;\n\n$return .= htmlspecialchars( \\IPS\\Text\\Parser::blankImage(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" data-src=\"<fileStore.core_Attachment>\/\nCONTENT;\n$return .= htmlspecialchars( $thumbnail, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\"\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\nsrc=\"<fileStore.core_Attachment>\/\nCONTENT;\n$return .= htmlspecialchars( $thumbnail, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\"\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n data-ratio=\"\nCONTENT;\n$return .= htmlspecialchars( $ratio, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" width=\"\nCONTENT;\n$return .= htmlspecialchars( $width, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" class=\"ipsImage ipsImage_thumbnailed\" alt=\"\nCONTENT;\n$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\"><\/a><\/p>\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction attachedVideo( $realUrl, $linkUrl, $title, $mimeType, $id ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n<video controls class=\"ipsEmbeddedVideo\" data-fileid=\"\nCONTENT;\n$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" \nCONTENT;\n\nif ( \\IPS\\Settings::i()->lazy_load_enabled ):\n$return .= <<<CONTENT\ndata-video-embed\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\ndata-controller=\"core.global.core.embeddedvideo\"\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n>\n\t<source \nCONTENT;\n\nif ( \\IPS\\Settings::i()->lazy_load_enabled ):\n$return .= <<<CONTENT\ndata-video-\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\nsrc=\"<fileStore.core_Attachment>\/\nCONTENT;\n$return .= htmlspecialchars( $realUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" type=\"\nCONTENT;\n$return .= htmlspecialchars( $mimeType, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\">\n\t<a class=\"ipsAttachLink\" href=\"\nCONTENT;\n$return .= htmlspecialchars( $linkUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\">\nCONTENT;\n$return .= htmlspecialchars( $title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n<\/a>\n<\/video>\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction code( $val, $editorId, $randomString, $language='html' ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n<div class=\"ipsPad ipsForm ipsForm_vertical\" data-controller='core.global.editor.code' data-editorid='\nCONTENT;\n$return .= htmlspecialchars( $editorId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' data-randomstring='\nCONTENT;\n$return .= htmlspecialchars( $randomString, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n'>\n\t<form method='get' action='#'>\n\t\t<div class=\"ipsPad ipsAreaBackground_light\">\n\t\t\t<div class=\"ipsFieldRow ipsFieldRow_fullWidth ipsFieldRow_primary ipsLoading\" data-role=\"codeContainer\">\n\t\t\t\t<textarea id='elCodeInput\nCONTENT;\n$return .= htmlspecialchars( $randomString, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n'>\nCONTENT;\n$return .= htmlspecialchars( $val, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n<\/textarea>\n\t\t\t<\/div>\n\t\t\t<div class='ipsFieldRow'>\n\t\t\t\t<button type='submit' class=\"ipsButton ipsButton_primary cEditorURLButton cEditorURLButtonInsert\" data-action=\"linkButton\">\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_media_insert', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/button>\n\t\t\t\t<div class=\"ipsPos_right\">\n\t\t\t\t\t<select id='elCodeMode\nCONTENT;\n$return .= htmlspecialchars( $randomString, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' data-role=\"codeModeSelect\" data-codeLanguage=\"\nCONTENT;\n$return .= htmlspecialchars( $language, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\">\n\t\t\t\t\t\t<option value=\"null\">\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_code_null', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/option>\n\t\t\t\t\t\t<option value=\"htmlmixed\" \nCONTENT;\n\nif ( $language == 'html' OR $language == 'htmlmixed' ):\n$return .= <<<CONTENT\nselected\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_code_htmlmixed', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/option>\n\t\t\t\t\t\t<option value=\"css\" \nCONTENT;\n\nif ( $language == 'css' ):\n$return .= <<<CONTENT\nselected\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_code_css', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/option>\n\t\t\t\t\t\t<option value=\"javascript\" \nCONTENT;\n\nif ( $language == 'javascript' ):\n$return .= <<<CONTENT\nselected\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_code_javascript', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/option>\n\t\t\t\t\t\t<option value=\"php\" \nCONTENT;\n\nif ( $language == 'php' ):\n$return .= <<<CONTENT\nselected\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_code_php', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/option>\n\t\t\t\t\t\t<option value=\"sql\" \nCONTENT;\n\nif ( $language == 'sql' ):\n$return .= <<<CONTENT\nselected\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_code_sql', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/option>\n\t\t\t\t\t\t<option value=\"xml\" \nCONTENT;\n\nif ( $language == 'xml' ):\n$return .= <<<CONTENT\nselected\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_code_xml', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/option>\n\t\t\t\t\t<\/select>\n\t\t\t\t<\/div>\n\t\t\t<\/div>\n\t\t<\/div>\n\t<\/form>\n<\/div>\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction fakeFormTemplate( $id, $action, $tabs, $hiddenValues, $actionButtons, $uploadField ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n<form accept-charset='utf-8' action=\"\nCONTENT;\n$return .= htmlspecialchars( $action, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" method=\"post\" \nCONTENT;\n\nif ( $uploadField ):\n$return .= <<<CONTENT\nenctype=\"multipart\/form-data\"\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n>\n\t<input type=\"hidden\" name=\"\nCONTENT;\n$return .= htmlspecialchars( $id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n_submitted\" value=\"1\">\n\t\nCONTENT;\n\nforeach ( $hiddenValues as $k => $v ):\n$return .= <<<CONTENT\n\n\t\t<input type=\"hidden\" name=\"\nCONTENT;\n$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" value=\"\nCONTENT;\n$return .= htmlspecialchars( $v, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\">\n\t\nCONTENT;\n\nendforeach;\n$return .= <<<CONTENT\n\n\t\nCONTENT;\n\nif ( $uploadField ):\n$return .= <<<CONTENT\n\n\t\t<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"\nCONTENT;\n$return .= htmlspecialchars( $uploadField, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\">\n\t\t<input type=\"hidden\" name=\"plupload\" value=\"\nCONTENT;\n\n$return .= htmlspecialchars( md5( mt_rand() ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\">\n\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\nCONTENT;\n\nforeach ( $tabs as $elements ):\n$return .= <<<CONTENT\n\n\t\t\nCONTENT;\n\nforeach ( $elements as $element ):\n$return .= <<<CONTENT\n\n\t\t\t{$element->html()}\n\t\t\nCONTENT;\n\nendforeach;\n$return .= <<<CONTENT\n\n\t\nCONTENT;\n\nendforeach;\n$return .= <<<CONTENT\n\n<\/form>\n\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction image( $editorId, $width, $height, $maximumWidth, $maximumHeight, $float, $link, $ratioWidth, $ratioHeight, $imageAlt, $editorUniqueId ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n<div class=\" ipsForm ipsForm_vertical\" data-controller=\"core.global.editor.image\" data-imageWidthRatio='\nCONTENT;\n$return .= htmlspecialchars( $ratioWidth, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' data-imageHeightRatio='\nCONTENT;\n$return .= htmlspecialchars( $ratioHeight, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' data-editorid='\nCONTENT;\n$return .= htmlspecialchars( $editorId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' data-editorUniqueId='\nCONTENT;\n$return .= htmlspecialchars( $editorUniqueId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n'>\n\t<form method='get' action='#'>\n\t\t<div class='ipsPad'>\n\t\t\t<div class=\"ipsFieldRow ipsFieldRow_fullWidth ipsFieldRow_primary\">\n\t\t\t\t<label class='ipsFieldRow_title'>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'image_link', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/label>\n\t\t\t\t<input type=\"text\" class=\"\" value=\"\nCONTENT;\n$return .= htmlspecialchars( $link, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" data-role=\"imageLink\">\n\t\t\t<\/div>\n\n\t\t\t<div class=\"ipsFieldRow ipsFieldRow_fullWidth ipsFieldRow_primary\">\n\t\t\t\t<label class='ipsFieldRow_title'>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'image_alt', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/label>\n\t\t\t\t<input type=\"text\" class=\"\" value=\"\nCONTENT;\n$return .= htmlspecialchars( $imageAlt, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" data-role=\"imageAlt\">\n\t\t\t\t<span class='ipsType_light'>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'image_alt_desc', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/span>\n\t\t\t<\/div>\n\n\t\t\t<div class=\"ipsFieldRow ipsFieldRow_primary\">\n\t\t\t\t<label class='ipsFieldRow_title'>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'image_size', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/label>\n\t\t\t\t<div class='ipsComposeArea_imageDims'>\n\t\t\t\t\t<input type=\"number\" class=\"ipsField_short\" value=\"\nCONTENT;\n$return .= htmlspecialchars( $width, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" max=\"\nCONTENT;\n$return .= htmlspecialchars( $maximumWidth, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" data-role=\"imageWidth\">\n\t\t\t\t\t<span class='ipsType_small ipsType_light'>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'image_width_help', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/span>\n\t\t\t\t<\/div> &times; \n\t\t\t\t<div class='ipsComposeArea_imageDims'>\n\t\t\t\t\t<input type=\"number\" class=\"ipsField_short\" value=\"\nCONTENT;\n$return .= htmlspecialchars( $height, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" max=\"\nCONTENT;\n$return .= htmlspecialchars( $maximumHeight, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" data-role=\"imageHeight\">\n\t\t\t\t\t<span class='ipsType_small ipsType_light'>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'image_height_help', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/span>\n\t\t\t\t<\/div> \nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'px', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n\n\t\t\t\t<p class='ipsType_reset ipsSpacer_top ipsSpacer_half'>\n\t\t\t\t\t<span class='ipsCustomInput'>\n\t\t\t\t\t\t<input type='checkbox' name='image_aspect_ratio' id='elEditorImageRatio' \nCONTENT;\n\nif ( round( \\IPS\\Request::i()->actualWidth \/ \\IPS\\Request::i()->actualHeight, 2 ) == round( $width \/ $height, 2 ) ):\n$return .= <<<CONTENT\nchecked\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n>\n\t\t\t\t\t\t<span><\/span>\n\t\t\t\t\t<\/span> <label for='elEditorImageRatio'>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'image_aspect', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/label>\n\t\t\t\t<\/p>\n\t\t\t\t<br>\n\t\t\t\t<span class=\"ipsType_warning\" data-role=\"imageSizeWarning\"><\/span>\n\t\t\t<\/div>\n\t\t\t<div class=\"ipsFieldRow ipsFieldRow_primary\">\n\t\t\t\t<label class='ipsFieldRow_title'>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'image_align', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/label>\n\t\t\t\t<ul class='ipsButton_split ipsComposeArea_imageAlign'>\n\t\t\t\t\t<li>\n\t\t\t\t\t\t<input type='radio' name='image_align' value='left' id='image_align_left' data-role=\"imageAlign\" \nCONTENT;\n\nif ( $float == 'left' ):\n$return .= <<<CONTENT\nchecked\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n class=''>\n\t\t\t\t\t\t<label for='image_align_left' class='ipsButton ipsButton_fullWidth \nCONTENT;\n\nif ( $float == 'left' ):\n$return .= <<<CONTENT\nipsButton_primary\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\nipsButton_light\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n ipsButton_small'>\n\t\t\t\t\t\t\t\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'image_align_left', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t<\/label>\n\t\t\t\t\t<\/li>\n\t\t\t\t\t<li>\n\t\t\t\t\t\t<input type='radio' name='image_align' value='' id='image_align_none' data-role=\"imageAlign\" \nCONTENT;\n\nif ( $float != 'left' and $float != 'right' ):\n$return .= <<<CONTENT\nchecked\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n class=''>\n\t\t\t\t\t\t<label for='image_align_none' class='ipsButton ipsButton_fullWidth \nCONTENT;\n\nif ( $float !== 'left' && $float !=='right' ):\n$return .= <<<CONTENT\nipsButton_primary\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\nipsButton_light\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n ipsButton_small'>\n\t\t\t\t\t\t\t\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'none', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t<\/label>\n\t\t\t\t\t<\/li>\n\t\t\t\t\t<li>\n\t\t\t\t\t\t<input type='radio' name='image_align' value='right' id='image_align_right' data-role=\"imageAlign\" \nCONTENT;\n\nif ( $float == 'right' ):\n$return .= <<<CONTENT\nchecked\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n class=''>\n\t\t\t\t\t\t<label for='image_align_right' class='ipsButton ipsButton_fullWidth \nCONTENT;\n\nif ( $float == 'right' ):\n$return .= <<<CONTENT\nipsButton_primary\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\nipsButton_light\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n ipsButton_small'>\n\t\t\t\t\t\t\t\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'image_align_right', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t<\/label>\n\t\t\t\t\t<\/li>\n\t\t\t\t<\/ul>\n\t\t\t<\/div>\n\t\t<\/div>\n\t\t<div class='ipsPad ipsAreaBackground ipsFieldRow'>\n\t\t\t<button type='submit' class=\"ipsButton ipsButton_primary ipsButton_large ipsButton_fullWidth\" autofocus>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'update', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/button>\n\t\t<\/div>\n\t<\/form>\n<\/div>\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction link( $val, $editorId ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n<div class=\"ipsPad ipsForm ipsForm_vertical\" data-controller='core.global.editor.link' data-editorid='\nCONTENT;\n$return .= htmlspecialchars( $editorId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' \nCONTENT;\n\nif ( \\IPS\\Request::i()->image ):\n$return .= <<<CONTENT\ndata-image=\"1\"\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\ndata-image=\"0\"\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n>\n\t<form method='get' action='#'>\n\t\t<div class=\"ipsPad ipsAreaBackground_light\">\n\t\t\t<div class=\"ipsFieldRow ipsFieldRow_fullWidth ipsFieldRow_primary\">\n\t\t\t\t<label for='elLinkURL\nCONTENT;\n$return .= htmlspecialchars( $editorId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' class='ipsFieldRow_title'>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'url', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/label>\n\t\t\t\t<input type=\"text\" id='elLinkURL\nCONTENT;\n$return .= htmlspecialchars( $editorId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' class=\"ipsField_fullWidth ipsField_primary cEditorURL\" placeholder=\"\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_link_url_label', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n\" data-role=\"linkURL\" value=\"\nCONTENT;\n$return .= htmlspecialchars( $val, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" autofocus>\n\t\t\t<\/div>\n\t\t\t\nCONTENT;\n\nif ( !\\IPS\\Request::i()->image and !\\IPS\\Request::i()->block ):\n$return .= <<<CONTENT\n\n\t\t\t\t<div class=\"ipsFieldRow ipsFieldRow_fullWidth\" data-role=\"linkTextRow\">\n\t\t\t\t\t<label for='elLinkText\nCONTENT;\n$return .= htmlspecialchars( $editorId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' class='ipsFieldRow_title'>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_link_text', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/label>\n\t\t\t\t\t<input type=\"text\" id='elLinkText\nCONTENT;\n$return .= htmlspecialchars( $editorId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' class=\"ipsField_fullWidth cEditorURL\" placeholder=\"\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_link_text_label', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n\" data-role=\"linkText\" \nCONTENT;\n\nif ( \\IPS\\Request::i()->title ):\n$return .= <<<CONTENT\nvalue=\"\nCONTENT;\n\n$return .= htmlspecialchars( \\IPS\\Request::i()->title, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\"\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\nvalue=\"\"\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n>\n\t\t\t\t<\/div>\n\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t<div class='ipsFieldRow'>\n\t\t\t\t<button type='submit' class=\"ipsButton ipsButton_primary cEditorURLButton cEditorURLButtonInsert\" data-action=\"linkButton\">\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_media_insert', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/button>\n\t\t\t\t\nCONTENT;\n\nif ( $val ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t&nbsp;\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'or', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n&nbsp;\n\t\t\t\t\t<button type=\"button\" class=\"ipsButton ipsButton_light ipsButton_small\" data-action=\"linkRemoveButton\">\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_link_remove', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/button>\n\t\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t<\/div>\n\t\t<\/div>\n\t<\/form>\n<\/div>\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction linkedImage( $imageUrl, $imageName ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n<p><img \nCONTENT;\n\nif ( \\IPS\\Settings::i()->lazy_load_enabled ):\n$return .= <<<CONTENT\nsrc=\"\nCONTENT;\n\n$return .= htmlspecialchars( \\IPS\\Text\\Parser::blankImage(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" data-\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\nsrc=\"\nCONTENT;\n$return .= htmlspecialchars( $imageUrl, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" class=\"ipsImage ipsImage_thumbnailed\" alt=\"\nCONTENT;\n$return .= htmlspecialchars( $imageName, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\"><\/p>\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction mentionRow( $member ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n<li class='ipsMenu_item ipsCursor_pointer' data-mentionhref='\nCONTENT;\n$return .= htmlspecialchars( $member->url(), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' data-mentionid='\nCONTENT;\n$return .= htmlspecialchars( $member->member_id, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' data-mentionhover='\nCONTENT;\n$return .= htmlspecialchars( $member->url()->setQueryString('do', 'hovercard'), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n'>\n\t<a>\n\t\t<img src='\nCONTENT;\n$return .= htmlspecialchars( $member->photo, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' alt='' class='ipsUserPhoto ipsUserPhoto_tiny' loading='lazy'>\n\t\t<span class=\"ipsPad_half\" data-role='mentionname'>\nCONTENT;\n$return .= htmlspecialchars( $member->name, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n<\/span>\n\t<\/a>\n<\/li>\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction myMedia( $editorId, $mediaSources, $currentMediaSource, $url, $results ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n\nCONTENT;\n\n$safeEditorId = preg_replace( \"\/[^a-zA-Z0-9\\-_]\/\", '_', $editorId );\n$return .= <<<CONTENT\n\n<div class=\"cMyMedia\" data-controller='core.global.editor.mymedia, core.global.editor.insertable' data-editorid='\nCONTENT;\n$return .= htmlspecialchars( $editorId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n'>\n\t<div id=\"elEditor\nCONTENT;\n$return .= htmlspecialchars( $safeEditorId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\nAttach\">\n\t\t\nCONTENT;\n\nif ( \\count( $mediaSources ) > 1 ):\n$return .= <<<CONTENT\n\n\t\t\t<div class=\"ipsColumns ipsColumns_collapsePhone\"  data-ipsTabBar data-ipsTabBar-contentArea='#elEditor\nCONTENT;\n$return .= htmlspecialchars( $safeEditorId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\nAttachTabContent' data-ipsTabBar-itemSelector=\".ipsSideMenu_item\" data-ipsTabBar-activeClass=\"ipsSideMenu_itemActive\" data-ipsTabBar-updateURL=\"false\">\n\t\t\t\t<div class=\"ipsColumn ipsColumn_medium\">\n\t\t\t\t\t<div class=\"ipsSideMenu ipsPad\" id='elAttachmentsMenu_\nCONTENT;\n$return .= htmlspecialchars( $safeEditorId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' data-ipsSideMenu>\n\t\t\t\t\t\t<h3 class='ipsSideMenu_mainTitle ipsAreaBackground_light ipsType_medium'>\n\t\t\t\t\t\t\t<a href='#elAttachmentsMenu_\nCONTENT;\n$return .= htmlspecialchars( $safeEditorId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n' class='ipsPad_double' data-action='openSideMenu'><i class='fa fa-bars'><\/i> &nbsp;\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_attachment_location', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n&nbsp;<i class='fa fa-caret-down'><\/i><\/a>\n\t\t\t\t\t\t<\/h3>\n\t\t\t\t\t\t<ul class=\"ipsSideMenu_list\">\n\t\t\t\t\t\t\t\nCONTENT;\n\nforeach ( $mediaSources as $k ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t\t\t<li>\n\t\t\t\t\t\t\t\t\t<a href=\"\nCONTENT;\n\n$return .= htmlspecialchars( \\IPS\\Http\\Url::internal( \"app=core&module=system&controller=editor&do=myMedia&tab={$k}&existing=1\", null, \"\", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );\n$return .= <<<CONTENT\n\" id=\"elEditor\nCONTENT;\n$return .= htmlspecialchars( $safeEditorId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\nAttachTabMedia\nCONTENT;\n$return .= htmlspecialchars( $k, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\" class=\"ipsSideMenu_item \nCONTENT;\n\nif ( $currentMediaSource == $k ):\n$return .= <<<CONTENT\nipsSideMenu_itemActive\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\">\nCONTENT;\n\n$val = \"editorMedia_{$k}\"; $return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( $val, ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/a>\n\t\t\t\t\t\t\t\t<\/li>\n\t\t\t\t\t\t\t\nCONTENT;\n\nendforeach;\n$return .= <<<CONTENT\n\n\t\t\t\t\t\t<\/ul>\n\t\t\t\t\t<\/div>\n\t\t\t\t<\/div>\n\t\t\t\t<div class=\"ipsColumn ipsColumn_fluid\">\n\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t<div id=\"elEditor\nCONTENT;\n$return .= htmlspecialchars( $safeEditorId, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\nAttachTabContent\" data-role=\"myMediaContent\" class='ipsPad'>\n\t\t\t\t\nCONTENT;\n\nif ( \\count( $mediaSources )  ):\n$return .= <<<CONTENT\n\n\t\t\t\t\t{$results}\n\t\t\t\t\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\n\n\t\t\t\t\t\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_no_media', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n\n\t\t\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t\t\t<\/div>\n\t\t\nCONTENT;\n\nif ( \\count( $mediaSources ) > 1 ):\n$return .= <<<CONTENT\n\n\t\t\t\t<\/div>\n\t\t\t<\/div>\n\t\t\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\t<\/div>\n\t<div class='ipsPad ipsAreaBackground cMyMedia_controls'>\n\t\t<ul class='ipsList_inline ipsType_right'>\n\t\t\t<li><a href='#' data-action=\"clearAll\" class='ipsButton ipsButton_verySmall ipsButton_veryLight ipsButton_disabled'>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_clear_selection', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/a><\/li>\n\t\t\t<li><a href='#' data-action=\"insertSelected\" class='ipsButton ipsButton_verySmall ipsButton_normal ipsButton_disabled'>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_image_upload_insert_selected', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/a><\/li>\n\t\t<\/ul>\n\t<\/div>\n<\/div>\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction myMediaContent( $files, $pagination, $url, $extension ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n<div data-controller='core.global.editor.mymediasection' data-url=\"\nCONTENT;\n$return .= htmlspecialchars( $url, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n&search=1\">\n\t<div class='ipsAreaBackground ipsPad_half'>\n\t\t<input type=\"search\" class=\"ipsField_fullWidth\" placeholder=\"\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'editor_media_search', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n\" data-role=\"myMediaSearch\">\n\t<\/div>\n\t<div data-role=\"myMediaResults\" data-extension=\"\nCONTENT;\n$return .= htmlspecialchars( $extension, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n\">\n\t\t\nCONTENT;\n\n$return .= \\IPS\\Theme::i()->getTemplate( \"editor\", \"core\", 'global' )->myMediaResults( $files, $pagination, $url, $extension );\n$return .= <<<CONTENT\n\n\t<\/div>\t\n<\/div>\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction myMediaResults( $files, $pagination, $url ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n\nCONTENT;\n\nif ( empty($files) ):\n$return .= <<<CONTENT\n\n\t<div class='ipsPad ipsAreaBackground_light'>\n\t\t\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'no_results', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n\n\t<\/div>\n\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\n\n\t<div class=\"ipsGrid ipsAttachment_fileList\">\n\t\t\nCONTENT;\n\nforeach ( $files as $url => $file ):\n$return .= <<<CONTENT\n\n\t\t\t\nCONTENT;\n\n$return .= \\IPS\\Theme::i()->getTemplate( \"forms\", \\IPS\\Request::i()->app, 'global' )->uploadFile( preg_replace( '\/' . preg_quote( \\IPS\\Settings::i()->base_url . 'applications\/core\/interface\/file\/attachment.php?id=', '\/' ) . '(\\d+)(&key=[a-z0-9]+)?\/i', '$1', $url ), $file, NULL, TRUE, TRUE, $url );\n$return .= <<<CONTENT\n\n\t\t\nCONTENT;\n\nendforeach;\n$return .= <<<CONTENT\n\n\t<\/div>\n\t<br>\n\t{$pagination}\n\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\nCONTENT;\n\n\t\treturn $return;\n}\n\n\tfunction preview( $editorID ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n<div data-controller='core.global.editor.preview' data-editorID='\nCONTENT;\n$return .= htmlspecialchars( $editorID, ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE );\n$return .= <<<CONTENT\n'>\n\t<div class='ipsPad ipsAreaBackground_reset ipsType_richText ipsType_break ipsType_contained ipsType_normal' data-role='previewContainer'>\n\n\t<\/div>\n<\/div>\nCONTENT;\n\n\t\treturn $return;\n}}"
VALUE;
