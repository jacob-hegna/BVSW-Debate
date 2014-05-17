BVSW Debate
========

The official website of the Blue Valley Southwest debate team

Developed originally by Jacob Hegna

config.php
==

The config.php file is not included as part of the repository to maintain the security of the database.
This is what the config.php file looks like without any options actually defined.  It is actually placed inside a folder named "data" outside of the official repo on openshift's servers, this ensures that all remote pushes do not reset the file.
```php
<?php
define('SERVER_IP', '');
define('SERVER_USER', '');
define('SERVER_PASS', '');
define('VERIFY_CODE', '');
?>