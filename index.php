<?php
if(isset($_COOKIE['proselec_alpha']) && $_COOKIE['proselec_alpha']) {
?>


<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="author" content="ProSelec" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="stylesheet" type="text/css" href="style/main.css" />
<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && isset($_SESSION['facid']) && $_SESSION['facid']) {	
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"style/fakultaet/181111" . $_SESSION['facid'] . ".css\" />\n";
}
elseif(isset($_COOKIE['proselec_facid'])) {
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"style/fakultaet/181111" . $_COOKIE['proselec_facid'] . ".css\" />\n";
}
else {
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"style/fakultaet/1811110.css\" />\n";
}
?>
<link rel="stylesheet" type="text/css" href="style/content.css" />
<title>ProSelec</title>
<?php require_once("social_media/fb.js"); ?> <!-- FACEBOOK SM -->

<!-- GOOGLE PLUS SM -->
<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
  {lang: 'de'}
</script>
</head>

<body>
<div id="wrap">
<div id="head">
<div id="logo"><img src="images/head/logo.png" alt="" /></div>
<div id="auth">
<?php
if(!isset($_SESSION['loggedin'])) {
?>
<form action="auth/login.php" method="post">
<table cellpadding="0" cellspacing="0" width="60%">
<tr valign="top"><td width="50%"><b>HFU E-Mail:</b></td> <td width="50%"><input name="mail" type="text" style="width:90%" value="<?php echo isset($_COOKIE['proselec_email']) && $_COOKIE['proselec_email'] ? $_COOKIE['proselec_email'] : ''; ?>" /></td></tr>
<tr valign="top"><td width="50%"><b>Passwort:</b></td> <td width="50%"><input name="password" type="password" style="width:90%"  /> <a href="#">Passwort vergessen?</a></td></tr>
<tr valign="top"><td width="50%">&nbsp;</td> <td width="50%" style="text-align:center"><input name="submit" type="submit" style="width:80%" class="auth_login_button" value="Einloggen" /></td></tr>
</table>
</form>
<?php
}
?>
</div>
<div id="nav">
<div class="nav_button"><div class="nav_button_text"><a href="?key=projektuebersicht">Projektübersicht</a></div></div> <div class="nav_button"><div class="nav_button_text"><a href="?key=projektvergabe">Projektvergabe</a></div></div>
<?php
if(isset($_SESSION['lecturer']) && $_SESSION['lecturer']) {
	echo '<div class="nav_button"><div class="nav_button_text"><a href="?key=lecturer_backend">Dozenten-Backend</a></div></div> ';
}
?>
<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
	echo '<div class="nav_button"><div class="nav_button_text"><a href="auth/logout.php">Logout</a></div></div>';
}
?>
</div>
</div>
<div id="hpc">
<?php
if(!isset($_GET['key'])) {
	$_GET['key']="home";
}

if($_GET['key'] == "home") include("content/home.inc.php");
if($_GET['key'] == "login") include("content/login.inc.php");
if($_GET['key'] == "projektvergabe") include("content/projektvergabe.inc.php");
if($_GET['key'] == "projektuebersicht") include("content/projektuebersicht.inc.php");
if($_GET['key'] == "firstlogin") include("content/first_login.inc.php");
if($_GET['key'] == "lecturer_backend") include("lecturer_backend/addproject.inc.php");
if($_GET['key'] == "contact") include("content/contact.inc.php");
?>
</div>
<div id="footer">
<div id="foot_top">
<div class="foot_1">
<a href="#">Über uns</a><br />
<a href="#">Presse</a><br />
<a href="index.php?key=contact">Kontakt</a><br />
<a href="#">Impressum</a>
</div>
<div class="foot_2">
<a href="#">FAQ</a><br />
<a href="#">Datenschutz</a><br />
<a href="#">Nutzungsbedingungen</a>
</div>
<div class="foot_3">
Copyright &copy; <?php echo date("Y"); ?> ProSelec
</div>
</div>
<div id="foot_bottom">
<img src="images/foot/logo_hfu.png" alt="" />
</div>
</div>
</div>
</div>
</body>
</html>

<?php
}
else {
	echo "Diese Website ist noch nicht für die Öffentlichkeit zugänglich (Zugriff nur mit Keks).";
}
?>