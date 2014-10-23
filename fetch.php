<?php

//URL for feed (Make sure it's the 2.0 version)
$feed_url = "http://ws.audioscrobbler.com/2.0/user/quadpiece/recenttracks";

 //Get all the shit
if ($feed_xml = file_get_contents($feed_url)) {
        $feed_data = simplexml_load_string($feed_xml);

        //Echo the actual list
        echo '<div class="trackscontainer">';
        echo '<ul>';
        foreach ($feed_data->track as $track) {
                echo '<li class="singletrack">';

                //Check if there is a cover image to use.
                if ($track->image[3] != "") {
                        echo '<div class="cover"><img class="cover" src="' . $track->image[3] . '" /></div>';
                }

                //Echo track artist, title and link
                echo '<div class="tracktextcontainer">';
                echo '<p class="tracktext"><span class="title">' . $track->artist . '</span><a href="' . $track->url . '"><br />' . $track->name . '</a></p>';

                //Echo N/A as time is song is currently being played
                if (!isset($track['nowplaying'])){
                        echo '<p class="tracktext">&nbsp;&nbsp;| Played: ' . $track->date . ' <small>(GMT)</small></p>';

                }
                else {
                        echo '<p class="tracktext">&nbsp;&nbsp;| Played: Now!</p>';
                }

                echo '</div>';

                //Echo that fancy Now Playing text thingy
                if (isset($track['nowplaying']) && $track['nowplaying'] == 'true'){
                        echo '<p class="nowplaying"><span class="title">Now playing!</p>';

                }
                echo '</li>';
        }
        echo '</ul>';
        echo '</div>';
}

//Copyright Quad - Messy PHP v. 420.69 update codename "blaze" revision 1337

?>
