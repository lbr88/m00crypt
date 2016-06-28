<?php
require("m00crypt.php");
$str = "2000";
echo "CLEAR: ".$str."\n";
echo "ENC: ".m00enc($str)."\n";
echo "DEC: ".m00dec(m00enc($str))."\n";
