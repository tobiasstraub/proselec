<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
	require_once("database/connect.inc.php");
	
	$primary=mysql_fetch_row(mysql_query("SELECT prjid FROM assignment WHERE userid=" . $_SESSION['userid'] . " AND priority=0"));
	$secundary=mysql_fetch_row(mysql_query("SELECT prjid FROM assignment WHERE userid=" . $_SESSION['userid'] . " AND priority=1"));
	if($primary) {
		$prim_title=mysql_fetch_row(mysql_query("SELECT title FROM project WHERE prjid=" . $primary[0] . ""));	
		$prim=$prim_title[0];
	}
	else {
		$prim="Sie haben noch keine Auswahl Ihres prim�ren Projektwunsches getroffen. Unter der Kategorie 'Projektvergabe' k�nnen Sie den prim�ren Projektwunsch �ber den Button 'W�hlen' festlegen.";
	}
	if($secundary) {
		$sec_title=mysql_fetch_row(mysql_query("SELECT title FROM project WHERE prjid=" . $secundary[0] . ""));
		$sec=$sec_title[0];
	}
	else {
		$sec="Sie haben noch keine Auswahl Ihres sekund�ren Projektwunsches getroffen. Unter der Kategorie 'Projektvergabe' k�nnen Sie den sekund�ren Projektwunsch �ber den Button 'W�hlen' festlegen.";	
	}
?>
<div id="content">
<div id="content_inner">
<b>Ihr Prim�rprojekt:</b> <?php echo $prim; ?><br />
<b>Ihr Sekund�rprojekt:</b> <?php echo $sec; ?><br />
</div>
</div>
<?php
require_once("database/disconnect.inc.php");
}
else {
	$_SESSION['message']="pwda";
	echo "<meta http-equiv=\"refresh\" content=\"0; URL=?key=login\">";
}
?>