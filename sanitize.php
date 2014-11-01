<?php
// COLLECTED FROM INTERNET
// SOURCE: UNKNOWN :(

// PREVENT CODE INJECTON
function cleanInput($text) {
	$text = trim(preg_replace(
		array(
			'@<script[^>]*?>.*?</script>@si',
			'@<[\/\!]*?[^<>]*?>@si',
			'@<style[^>]*?>.*?</style>@si',
			'@<![\s\S]*?--[ \t\n\r]*>@',
			'@<object[^>]*?>.*?</object>@si',
			'@<embed[^>]*?>.*?</embed>@si',
			'@<iframe[^>]*?>.*?</iframe>@si',
			'@<applet[^>]*?>.*?</applet>@si',
			'@<noframes[^>]*?>.*?</noframes>@si',
			'@<noscript[^>]*?>.*?</noscript>@si',
			'@<noembed[^>]*?>.*?</noembeded>@si'
		),
		array('','','','','','','','','','',''),
		$text
	));
	return $text;
}

// SQL INJECTION WITH 
function sanitize($text) {
	if (is_array($text)) {
		foreach($text as $var=>$val) {
			$output[$var] = sanitize($val);
		}
	} else {
		if (get_magic_quotes_gpc()) {
			$text = stripslashes($text);
		}
		$text = cleanInput($text);
		$output = mysql_real_escape_string($text);
	}
	return $output;
}

function sanitizeLite($text) {
	if (is_array($text)) {
		foreach($text as $var=>$val) {
			$output[$var] = sanitizeLite($val);
		}
	} else {
		if (get_magic_quotes_gpc()) {
			$text = stripslashes($text);
		}
		$output = mysql_real_escape_string($text);
	}
	return $output;
}

?>