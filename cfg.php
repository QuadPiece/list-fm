<?php
// Is this allowed to take data from the requested one at the url?
define('URL_USER', true);
// Who is the default user?
define('DEFAULT_USER', "DahHowl");
// Number of entries. Last.fm API allows a maxium of 200 entries, tho that's discouraged because that can cause the page to be
// loaded very slowly.
define('LIMIT', 30);
// What should be in the index.php <title> tag?
define('TITLE_TAG', NULL);
// custom css, put the directory where it is.
define('CSS_DIR', NULL);
// Put the fancy background thing "Recently played..."?
define('USESTREAMTITLE', true);
// Set a custom title for it, if you wish.
define('CUST_STREAM_TITLE', NULL);
// Use cache or not? This avoids loading the page with the data every time.
define('CACHE', true);
// Cache expire
define('CACHE_EXPIRE_TIME', 60 * 2);