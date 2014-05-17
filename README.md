
<!-- saved from url=(0107)https://raw.githubusercontent.com/jacob-hegna/bvswdebate/8813fdcc00ce07186b57ae8e81bdb9a653105979/README.md -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><style type="text/css"></style></head><body><pre style="word-wrap: break-word; white-space: pre-wrap;">BVSW Debate
========

The official website of the Blue Valley Southwest debate team

Developed originally by Jacob Hegna

config.php
==

The config.php file is not included as part of the repository to maintain the security of the database.
This is what the config.php file looks like without any options actually defined.  It is actually placed inside a folder named "data" outside of the official repo on openshift's servers, this ensures that all remote pushes do not reset the file.
```php
&lt;?php
define('SERVER_IP', '');
define('SERVER_USER', '');
define('SERVER_PASS', '');
define('VERIFY_CODE', '');
?&gt;
```</pre></body></html>