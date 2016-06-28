<?php
require("m00crypt.table.inc.php");

function m00enc($str) {
	global $m00enc;
	$encoded = "m00";
	foreach(str_split($str) as $chr) {
		$encoded .= $m00enc[ord($chr)];
	}
	return $encoded;
}
//echo m00enc("test\n");

function m00dec($str) {
	global $m00dec, $m00enc;
	if (substr($str,0,3) != "m00") return false;
	$str = substr($str,3);
	if ((strlen($str) % strlen($m00enc[0])) == 0) {
		$chunks = str_split($str, strlen($m00enc[0]));
		$decoded = "";
		foreach ($chunks as $chunk) {
			$decoded .= chr($m00dec[$chunk]);
		}
		return $decoded;
	} else {
		return false;
	}
}
