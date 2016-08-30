<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
?>
<form action="content/contact_send.php" method="POST">
<table style="width:200px; height:100 background-color:#ccc; color:#123456;">
<tr><td>E-Mail</td><td><?php echo $_SESSION['usermail'] ?></td></tr>
<tr><td>Betreff</td><td><input type="text" name="Betreff"></td></tr>
<tr><td>Nachricht</td><td><textarea name="Eintrag" cols="40" rows="8"></textarea></td></tr>
<tr><td><input type="submit" value="senden" name="senden"></td><td><input type="reset" value="zur&uuml;cksetzen" name="reset"></td></tr>
</table>
</form></p>
<?php
}
else {
	include("content/contact_loggedout.inc.php");
}
?>
