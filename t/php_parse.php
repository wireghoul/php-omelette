#!/usr/bin/php
<?php
/* Print out tokens
 * https://github.com/php/php-src/blob/master/Zend/zend_language_parser.y
 */
echo "\nPARSING: $argv[1]\n=================================================\n";
$tokens = token_get_all(file_get_contents($argv[1]));

foreach ($tokens as $token) {
    if (is_array($token)) {
        echo "Line {$token[2]}: ", token_name($token[0]), " ('{$token[1]}')", PHP_EOL;
    }
}
echo "\n";
?>
