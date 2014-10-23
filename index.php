<?php

//This will only edit the site and has no effect on the back-end at all
$username = "Quad"

?>

<!-- fm.lister by Leafcat -->

<html>
	<head>
		<title>Recent last.fm tracks by <?php echo $username ?></title>
		<link rel="stylesheet" type="text/css" href="tracklist.css">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<meta charset="UTF-8">
	</head>
	<body>
		<p class="streamtitle">Recently played tracks<small> (via Last.fm)</small></p>

		<?php include_once 'fetch.php' ?>

	</body>
</html>