<?php

return <<<'VALUE'
"namespace IPS\\Theme;\n\tfunction email_html_core_notification_unapproved_content( $content, $member, $email ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n\n\nCONTENT;\n\nif ( $content->author()->member_id ):\n$return .= <<<CONTENT\n\n{$email->language->addToStack(\"email_new_content_unapproved\", FALSE, array( 'sprintf' => array( $content->author()->url(), $content->author()->name, $content->indefiniteArticle( $email->language ) ) ) )} <a href='{$content->url()}'>\nCONTENT;\n\nif ( $content instanceof \\IPS\\Content\\Comment OR $content instanceof \\IPS\\Content\\Review ):\n$return .= <<<CONTENT\n{$content->item()->mapped('title')}\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\n{$content->mapped('title')}\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n<\/a>\n\nCONTENT;\n\nelseif ( $content->author()->real_name ):\n$return .= <<<CONTENT\n\n{$email->language->addToStack(\"email_new_content_unapproved_guest\", FALSE, array( 'sprintf' => array( $email->language->addToStack( 'guest_name_shown', NULL, array( 'sprintf' => array( $content->author()->real_name ) ) ), $content->indefiniteArticle( $email->language ) ) ) )} <a href='{$content->url()}'>\nCONTENT;\n\nif ( $content instanceof \\IPS\\Content\\Comment OR $content instanceof \\IPS\\Content\\Review ):\n$return .= <<<CONTENT\n{$content->item()->mapped('title')}\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\n{$content->mapped('title')}\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n<\/a>\n\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\n\n{$email->language->addToStack(\"email_new_content_unapproved_guest\", FALSE, array( 'sprintf' => array( $email->language->addToStack( 'guest_name_shown', NULL, array( 'sprintf' => array( $email->language->addToStack('guest') ) ) ), $content->indefiniteArticle( $email->language ) ) ) )} <a href='{$content->url()}'>\nCONTENT;\n\nif ( $content instanceof \\IPS\\Content\\Comment OR $content instanceof \\IPS\\Content\\Review ):\n$return .= <<<CONTENT\n{$content->item()->mapped('title')}\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\n{$content->mapped('title')}\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n<\/a>\n\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\n<br \/>\n<br \/>\n\n{$content->emailContent( $email, 'html' )}\n<br \/><br \/>\n<em style='color: #8c8c8c'>&mdash; \nCONTENT;\n\n$return .= \\IPS\\Settings::i()->board_name;\n$return .= <<<CONTENT\n<\/em>\nCONTENT;\n\n\t\treturn $return;\n}\n\tfunction email_plaintext_core_notification_unapproved_content( $content, $member, $email ) {\n\t\t$return = '';\n\t\t$return .= <<<CONTENT\n\n\n\nCONTENT;\n\nif ( $content->author()->member_id ):\n$return .= <<<CONTENT\n\n{$email->language->addToStack(\"email_new_content_unapproved_plain\", FALSE, array( 'htmlsprintf' => array( $content->author()->name, $content->indefiniteArticle( $email->language ) ) ) )} {$content->mapped('title')}\n\nCONTENT;\n\nelse:\n$return .= <<<CONTENT\n\n{$email->language->addToStack(\"email_new_content_unapproved_plain\", FALSE, array( 'htmlsprintf' => array( $content->author()->real_name ? $email->language->addToStack( 'guest_name_shown', NULL, array( 'htmlsprintf' => array( $content->author()->real_name ) ) ) : $email->language->addToStack( 'guest_name_shown', NULL, array( 'htmlsprintf' => array( $email->language->addToStack('guest') ) ) ), $content->indefiniteArticle( $email->language ) ) ) )} {$content->mapped('title')}\n\nCONTENT;\n\nendif;\n$return .= <<<CONTENT\n\n\n\n\n{$content->emailContent( $email, 'plaintext' )}\n\n-- \nCONTENT;\n\n$return .= \\IPS\\Settings::i()->board_name;\n$return .= <<<CONTENT\n\nCONTENT;\n\n\t\treturn $return;\n}"
VALUE;
