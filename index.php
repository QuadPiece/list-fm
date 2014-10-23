<?php
require_once "tpl.php";
require_once "fetch.php";
$username = "Quad";
$tpl = new RainTPL;
$assign = array(
	"username" => $username,
	"content" => $output,
	);
$tpl->assign($assign);
echo $tpl->draw('page', $return_string = true);