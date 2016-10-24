<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Instagram Plugin - InstaLink Lite</title>

	<style>body { margin: 0; font-family: 'Open Sans', Arial, Sans-Serif;}</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	
	<link href="<?php echo dirname(dirname($_SERVER['REQUEST_URI'])); ?>/assets/instalink-lite/instalink-lite-1.3.0.min.css" rel="stylesheet">
	<script src="<?php echo dirname(dirname($_SERVER['REQUEST_URI'])); ?>/assets/instalink-lite/instalink-lite-1.3.0.min.js"></script>
</head>
<body>
	<?php if (!empty($_GET['access_token'])) { ?>
		<div data-il
			 <?php echo !empty($_GET['access_token']) ? 'data-il-access-token="' . htmlentities($_GET['access_token']) . '"' : ""; ?>
			 data-il-width="<?php echo !empty($_GET['width']) ? htmlentities($_GET['width']) : ""; ?>"
			 data-il-height="<?php echo !empty($_GET['height']) ? htmlentities($_GET['height']) : ""; ?>"
			 data-il-image-size="<?php echo !empty($_GET['image_size']) ? htmlentities($_GET['image_size']) : ""; ?>"
			 data-il-bg-color="<?php echo !empty($_GET['bg_color']) ? htmlentities($_GET['bg_color']) : ""; ?>">
		</div>
	<?php } else { ?>
		You need to connect InstaLink Lite to Instagram with the help of Access Token.
	<?php } ?>
</body>
</html>