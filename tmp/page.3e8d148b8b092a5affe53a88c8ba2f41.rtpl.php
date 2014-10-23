<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html>
	<head>
		<title>Recent last.fm tracks by <?php echo $username;?></title>
		<link rel="stylesheet" type="text/css" href="tracklist.css">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<meta charset="UTF-8">
	</head>
	<body>
		<p class="streamtitle">Recently played tracks of <?php echo $username;?><small> (via Last.fm)</small></p>

		<?php echo $content;?>

	</body>
</html>