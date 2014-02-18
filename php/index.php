<?php
require("modules/class.Page.php");
require("modules/page/class.HomePage.php");

$page = new HomePage();
$page->writePage();
?>