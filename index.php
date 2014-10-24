<?php
require_once "tpl.php";
require_once "cfg.php";
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
if (file_exists("cached/" . $username . ".html")) {
	$filecont = file_get_contents("cached/" . $username . ".html");
	if (preg_match_all("<!-- Cached at: (\d*) -->", $filecont, $matches)) {
		if (CACHE_EXPIRE_TIME + time() > $matches[1][0]) {
			echo $filecont;
			exit;
		}
	}
}
$feed_url = "http://ws.audioscrobbler.com/2.0/user/" . $username . "/recenttracks";
$output = "";
if ($feed_xml = file_get_contents($feed_url)) {
	$feed_data = simplexml_load_string($feed_xml);        
	$output .= '<div class="trackscontainer"><ul>';
	foreach ($feed_data->track as $track) {
		$output .= '<li class="singletrack">';
		if ($track->image[3] != "") {
			$output .= '<div class="cover"><img class="cover" src="' . $track->image[3] . '" /></div>';
		}
		$output .= '<div class="tracktextcontainer"><p class="tracktext"><span class="title">' . $track->artist . '</span><a href="' . $track->url . '"><br />' . $track->name . '</a></p>';
		if (!isset($track['nowplaying'])){
			$output .= '<p class="tracktext">&nbsp;&nbsp;| Played: ' . $track->date . ' <small>(GMT)</small></p>';

		}
		else {
			$output .= '<p class="tracktext">&nbsp;&nbsp;| Played: Now!</p>';
		}
		$output .= '</div>';
		if (isset($track['nowplaying']) && $track['nowplaying'] == 'true'){
			$output .= '<p class="nowplaying"><span class="title">Now playing!</p>';

		}
		$output .= '</li>';
	}
	$output .= '</ul></div>';
}
$tpl = new RainTPL;
$assign = array(
	"username" => $username,
	"content" => $output,
	"pagetitle" => TITLE_TAG,
	"customcss" => CSS_DIR,
	"usestreamtitle" => USESTREAMTITLE,
	"streamtitle" => CUST_STREAM_TITLE,
	);
$tpl->assign($assign);
$draw = $tpl->draw('page', $return_string = true);
file_put_contents("cached/" . $username . ".html", $draw);
echo $draw;