<html>
<head>
<title>Session und Cookie</title>
</head>
<body>
<div style="font-size:40px">
<?php
session_start();
echo "<b>Sessioncontents:</b><br />";
foreach($_SESSION as $key => $value) {
	echo $key . "=" . $value . "<br />";	
}

echo "<br /><br /><br />";

echo "<b>Cookiecontents:</b><br />";
foreach($_COOKIE as $key => $value) {
	echo $key . "=" . $value . "<br />";	
}
?>
</div>
</body>
</html>