<?php

return <<<'VALUE'
"namespace IPS\\Theme;\nclass class_cms_admin_pages extends \\IPS\\Theme\\Template\n{\n\tpublic $cache_key = '1b548ec354755beb6c8f9e7a16001357';\n\tfunction previewTemplateLink(  ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n<span data-role=\"viewTemplate\" class='ipsButton ipsButton_light ipsButton_verySmall'>\nCONTENT;\n\n$return .= \\IPS\\Member::loggedIn()->language()->addToStack( htmlspecialchars( 'cms_block_view_template', ENT_DISALLOWED, 'UTF-8', FALSE ), TRUE, array(  ) );\n$return .= <<<CONTENT\n<\/span>\nCONTENT;\n\n\t\treturn $return;\n}}"
VALUE;
