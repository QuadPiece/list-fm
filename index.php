<?php
require_once "tpl.php";
require_once "cfg.php";
function xml2array ( $xmlObject, $out = array () )
{
    foreach ( (array) $xmlObject as $index => $node )
        $out[$index] = ( is_object ( $node ) ) ? xml2array ( $node ) : $node;

    return $out;
}
if (URL_USER) {
	if (isset($_GET["u"])) {
		$username = $_GET["u"];
	}
	else {
		$default = true;
	}
}
if (isset($default) && $default || !URL_USER) {
	$username = DEFAULT_USER;
}
if (CACHE) {
	if (file_exists("cached/" . $username . ".html")) {
		$filecont = file_get_contents("cached/" . $username . ".html");
		if (preg_match_all("<!-- Cached at: (\d*) -->", $filecont, $matches)) {
			if (time() - CACHE_EXPIRE_TIME < $matches[1][0]) {
				echo $filecont;
				exit;
			}
		}
	}
}
$feed_url = "http://ws.audioscrobbler.com/2.0/user/" . $username . "/recenttracks?limit=" . LIMIT;
if ($feed_xml = file_get_contents($feed_url)) {
	$feed_data = xml2array(simplexml_load_string($feed_xml));
}
$tpl = new RainTPL;
$assign = array(
	"username" => $username,
	"content" => $feed_data["track"],
	"pagetitle" => TITLE_TAG,
	"customcss" => CSS_DIR,
	"usestreamtitle" => USESTREAMTITLE,
	"streamtitle" => CUST_STREAM_TITLE,
	"cache" => CACHE,
	);
$tpl->assign($assign);
$draw = $tpl->draw('page', $return_string = true);
if (CACHE) {
	file_put_contents("cached/" . $username . ".html", $draw);
}
echo $draw;