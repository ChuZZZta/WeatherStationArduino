
<?php

	echo "dzialaj ;<";
$fp = fopen("http://192.168.0.200", "rb");
if (FALSE === $fp) {
    exit("Failed to open stream to URL");
}

$result = '';

while (!feof($fp)) {
    $result .= fread($fp, 8192);
}
fclose($fp);
echo $result;

?>
