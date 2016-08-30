<?php
if($_SESSION['first_login']) {
?>
<div id="content">
<div id="content_inner">
<script type="text/javascript" src="biblio/jquery.js"></script>
<script type="text/javascript">
$(function() {
	$("#studycourse").hide();
    $("#faculty").change(function() {
       var val = $(this).val();
		$("#faculty option:first").hide();
		$("#studycourse").show();
		$("#studycourse option").remove();
		$('#studycourse_db').load('content/zusatz.inc.php?facid='+val);
    });
});				   
</script>

<div id="studycourse_db"></div>
<form action="auth/activation_e.php" method="post">
<table cellpadding="0" cellspacing="0" width="100%">
<tr valign="top">
<td width="40%">Bitte wählen Sie Ihre Fakultät:</td>
<td width="60%">
<select id="faculty" name="faculty" style="width:90%">
<option>[Bitte Fakultät wählen]</option>
<?php
require_once("database/connect.inc.php");
for($i=1; $i<=mysql_num_rows(mysql_query("SELECT faculty FROM faculty")); $i++) {
	$result=mysql_fetch_row(mysql_query("SELECT faculty FROM faculty WHERE facid='" . $i . "'"));
	echo '<option value="' . $i . '">' . $result[0] . '</option>';
}
?>
</select>
</td>
</tr>
<tr valign="top">
<td width="40%">Bitte wählen Sie Ihren Studiengang:</td>
<td width="60%">
<select id="studycourse" name="studycourse" style="width:90%">
<option>[Keine Auswahlliste]</option>
</select>
</form>
</td>
</tr>
<tr valign="top">
<td width="40%">Bitte wählen Sie Ihr aktuelles Semester:</td>
<td valign="top">
<select id="semester" name="semester" style="width:90%">
<option value="1">1. Semester</option>
<option value="2">2. Semester</option>
<option value="3">3. Semester</option>
<option value="4">4. Semester</option>
<option value="5">5. Semester</option>
<option value="6">6. Semester</option>
<option value="7">7. Semester</option>
</select>
</td>
</tr>
</table>
<input type="submit" name="submit" value="Regestrierung abschließen" />
</form>
</div>
</div>
<?php
require_once("database/disconnect.inc.php");
}
?>