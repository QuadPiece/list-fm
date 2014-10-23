<?php

//This thing is used to echo the data while working on it. Not an actual part of the project.

$feed_url = "http://ws.audioscrobbler.com/2.0/user/quadpiece/recenttracks";

$scrobbler_xml = file_get_contents($feed_url);

echo $scrobbler_xml;