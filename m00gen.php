#!/usr/bin/php
<?php
ini_set('memory_limit',"100M");
// v = aeiouy
// k = bcdfghjklmnpqrstvwxz
// c = abcdefghijklmnopqrstuvwxyz
// n = 0123456789
$chunksize = 6;
$ascii_start = 0;
$ascii_end = 255;

$chars = "oO0";


/////////////////////////////////////
/////////// DO NOT TOUCH ////////////
/////////////////////////////////////

$chunks = array();
$char_array = str_split($chars);

function r() {
	global $char_array, $chars;
	shuffle($char_array);
	return $char_array[rand(0,strlen($chars)-1)];
}

$max = ($ascii_end - $ascii_start)+1;
echo "Generating...\n\n";
for ($i = 0; $i < $max; $i++) {

	$chunk = "";
	for ($ii = 0; $ii < $chunksize; $ii++) {
		$chunk .= r();
	}
	if (!in_array($chunk,$chunks)) {
		$chunks[] = $chunk;
		$failed = 0;
	} else {
		if ($failed > 10000) {
			break;
		}
		$failed++;
		$i--;
	}
}
unlink("m00crypt.table.inc.php");
$f = fopen("m00crypt.table.inc.php","w");
fwrite($f,'<?php'."\n");
for($iii=$ascii_start; $iii < $ascii_end+1;$iii++) {
	fputs($f,'$m00enc['.$iii.'] = "'.$chunks[$iii].'";'."\n");
	fputs($f,'$m00dec["'.$chunks[$iii].'"] = "'.$iii.'";'."\n");
}
fwrite($f,'?>');
fclose($f);
echo "done writing m00crypt.table.inc.php\n";

?>
