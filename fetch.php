<?php

//URL for feed (Make sure it's the 2.0 version)
$feed_url = "http://ws.audioscrobbler.com/2.0/user/quadpiece/recenttracks";

$output = "";
 //Get all the shit
if ($feed_xml = file_get_contents($feed_url)) {
        $feed_data = simplexml_load_string($feed_xml);        
        
        //$output .= the actual list
        $output .= '<div class="trackscontainer">';
        $output .= '<ul>';
        foreach ($feed_data->track as $track) {
                $output .= '<li class="singletrack">';

                //Check if there is a cover image to use.
                if ($track->image[3] != "") {
                        $output .= '<div class="cover"><img class="cover" src="' . $track->image[3] . '" /></div>';
                }

                //$output .= track artist, title and link
                $output .= '<div class="tracktextcontainer">';
                $output .= '<p class="tracktext"><span class="title">' . $track->artist . '</span><a href="' . $track->url . '"><br />' . $track->name . '</a></p>';

                //$output .= N/A as time is song is currently being played
                if (!isset($track['nowplaying'])){
                        $output .= '<p class="tracktext">&nbsp;&nbsp;| Played: ' . $track->date . ' <small>(GMT)</small></p>';

                }
                else {
                        $output .= '<p class="tracktext">&nbsp;&nbsp;| Played: N/A</p>';
                }

                $output .= '</div>';

                //$output .= that fancy Now Playing text thingy
                if (isset($track['nowplaying']) && $track['nowplaying'] == 'true'){
                        $output .= '<p class="nowplaying"><span class="title">Now playing!</p>';

                }
                $output .= '</li>';
        }
        $output .= '</ul>';
        $output .= '</div>';
}

//Copyright Quad - Messy PHP v. 420.69 update codename "blaze" revision 1337

?>