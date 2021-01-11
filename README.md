PHP OMELETTE
===============================================================================
A code fragmentation technique for avoiding filtering or detection from things 
like web application firewalls. Inspired by the concept of fragmented shellcode
used in memory corruption [omelet][1] and can scatter fragmented PHP code
through log files yet still execute it as a single bit of PHP.

The broad concept is:
  1. Everything inside the `<?php` `?>` tags is code
  2. Everything inside the `/*` `*/` multi line comments are ignored
  3. PHP parsing has some flexibility

The preferred use of this is to inject a small stager payload, but bigger files
could be transformed as well.

The steps are simple enough that they can be performed manually:
  1. Add comment after all opening tags
  2. Add comment before all closing tags
  3. Add comments before and after semi colons
  4. Add comment after comma
  5. Add comments before and after opening and closing pharanteses
  6. Remove duplicate comments
  7. Insert new line before each closing multi line comment
  8. Remove empty lines

More steps can be added, or you can implement your own version, but keeping
them simple means you can use the steps on other languages like JavaScript as
well.

This repository includes some scripts to help automate the process of
fragmenting and injecting the code, and some "debugging" tools. The automated
process is not syntax aware so beware when using strings or embedding PHP in
things like HTML.

omelette
-------------------------------------------------------------------------------
The main script for fragmenting PHP code, uses regex to generate fragmented PHP
code. Code is given as the first agrument. Examples:

```bash
$ ./omelette '<?=eval($_GET[0])?>'
$ ./omelette "$(cat t/shell3.php)" > plate
```

injectlog.sh and injectUA.sh
-------------------------------------------------------------------------------
Automatically fragment and inject the omelette to a website. Takes PHP code as
first argument and a URL as the second. Will send injection as parameter or via
UserAgent. Examples:

```bash
$ ./injectlog.sh '<?php phpinfo(); ?>' 'http://example.com?id=1&inject='
$ ./injectUA.sh "$(cat t/shell1.php)" http://example.com
```
view-clean.sh
-------------------------------------------------------------------------------
Tries to show the fragmented code in a cleaner/readable format. Example:

```
./view-clean.sh ./plate
```

php_parse.php
-------------------------------------------------------------------------------
Breaks PHP code into parsed tokens, handy when seeing how the PHP parser deals
with fragmented code:

```
php php_parse.php ./file
```

Credits
===============================================================================
Wireghoul - http://www.justanotherhacker.com

References:
[1]: <https://www.corelan.be/index.php/2010/08/22/exploit-notes-win32-eggs-to-omelet/> "Eggs to omelet"
