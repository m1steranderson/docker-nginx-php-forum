<?php

return <<<'VALUE'
"namespace IPS\\Theme;\n\tfunction email_html_core_unsubscribeNotification( $key, $member, $email ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n\nCONTENT;\n\nif ( $member instanceof \\IPS\\Member ):\n$return .= <<<CONTENT\n\n\t<tr>\n\t\t<td dir='{dir}' valign=\"top\"><img src='\nCONTENT;\n\n$return .= \\IPS\\Settings::i()->base_url;\n$return .= <<<CONTENT\napplications\/core\/interface\/email\/spacer.png' width='1' height='1' alt=''><\/td>\n\t\t<td dir='{dir}' valign='middle' align='center' style=\"font-family: 'Helvetica Neue', helvetica, sans-serif; font-size: 12px; line-height: 18px; padding-left: 10px;\">\n\t\t\t{$email->language->addToStack(\"unsubscribe_blurb\", FALSE)} <a href=\"\nCONTENT;\n\n$return .= htmlspecialchars( \\IPS\\Http\\Url::internal( \"app=core&module=system&controller=notifications&do=options&type={$key}\", null, \"notifications_options\", array(), 0 ), ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', TRUE );\n$return .= <<<CONTENT\n\" style='color: #4a8aca; text-decoration: none; display: inline-block'>{$email->language->addToStack( 'adjust_notification_prefs', FALSE )}<\/a>.\n\t\t\t<br \/>\n\t\t<\/td>\n\t<\/tr>\n\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\nCONTENT;\n\n\t\treturn $return;\n}\n\tfunction email_plaintext_core_unsubscribeNotification( $key, $member, $email ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n{$email->language->addToStack(\"unsubscribe_blurb\", FALSE)} {$email->language->addToStack( 'adjust_notification_prefs', FALSE )}: \nCONTENT;\n\n$return .= \\IPS\\Http\\Url::internal( \"app=core&module=system&controller=notifications&do=options&type={$key}\", null, \"notifications_options\", array(), 0 );\n$return .= <<<CONTENT\n\nCONTENT;\n\n\t\treturn $return;\n}"
VALUE;
