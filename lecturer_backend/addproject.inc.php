<?php
if(isset($_SESSION['lecturer']) && $_SESSION['lecturer']) {
?>



<div id="content">
<div id="content_inner">

<script type="text/javascript" src="lecturer_backend/wysiwyg/jscripts/tiny_mce/tiny_mce.js" ></script>
<script type="text/javascript" >
tinyMCE.init({
		language : "de",
        mode : "textareas",
        theme : "advanced",
        plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
		
// Theme options
theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist",
theme_advanced_buttons2 : "",
theme_advanced_buttons3 : "", 
theme_advanced_buttons4 : "",
theme_advanced_toolbar_location : "top",
theme_advanced_toolbar_align : "left",
// theme_advanced_statusbar_location : "bottom",
theme_advanced_resizing : false,
		
// Skin options
skin : "o2k7",
skin_variant : "silver",


});
</script>
<?php
if(isset($_SESSION['lecturer_message']) && $_SESSION['lecturer_message']=="addprojectok") {
	echo "<b>Ihr Projekt wurde erstellt.</b>";
}
?>
<form action="lecturer_backend/addproject_entry.php" method="post">
<p><b><font size="+1">Projekttitel:</font></b> <input type="text" size="60" name="prjtitle" /></p>
<br /><br /> 

<textarea name="content" style="width:90%; height:350px"> Hier k&ouml;nnen Sie ihre Projektebeschreibung eintragen.</textarea><br /> 
<table cellpadding="0" cellpadding="0" width="100%">
<tr valign="top">
<td width="20%">Maximale Personenanzahl:</td> <td width="10%"><input type="text" size="1" name="prjusersize" /></td>
<td width="15%"><b>Abgabeuhrzeit:</b></td>
<td width="15%">
<select name="time" size=1>
                    <option value="00:00">00:00</option>
                    <option value="00:30">00:30</option>
                    <option value="01:00">01:00</option>
                    <option value="01:30">01:30</option>
                    <option value="02:00">02:00</option>
                    <option value="02:30">02:30</option>
                    <option value="03:00">03:00</option>
                    <option value="03:30">03:30</option>
                    <option value="04:00">04:00</option>
                    <option value="04:30">04:30</option>
                    <option value="05:00">05:00</option>
                    <option value="05:30">05:30</option>
                    <option value="06:00">06:00</option>
                    <option value="06:30">06:30</option>
                    <option value="07:00">07:00</option>
                    <option value="07:30">07:30</option>
                    <option value="08:00">08:00</option>
                    <option value="08:30">08:30</option>
                    <option value="09:00">09:00</option>
                    <option value="09:30">09:30</option>
                    <option value="10:00">10:00</option>
                    <option value="10:30">10:30</option>
                    <option value="11:00">11:00</option>
                    <option value="11:30">11:30</option>
                    <option value="12:00">12:00</option>
                    <option value="12:30">12:30</option>
                    <option value="13:00">13:00</option>
                    <option value="13:30">13:30</option>
                    <option value="14:00">14:00</option>
                    <option value="14:30">14:30</option>
                    <option value="15:00">15:00</option>
                    <option value="15:30">15:30</option>
                    <option value="16:00">16:00</option>
                    <option value="16:30">16:30</option>
                    <option value="17:00">17:00</option>
                    <option value="17:30">17:30</option>
                    <option value="18:00">18:00</option>
                    <option value="18:30">18:30</option>
                    <option value="19:00">19:00</option>
                    <option value="19:30">19:30</option>
                    <option value="20:00">20:00</option>
                    <option value="20:30">20:30</option>
                    <option value="21:00">21:00</option>
                    <option value="21:30">21:30</option>
                    <option value="22:00">22:00</option>
                    <option value="22:30">22:30</option>
                    <option value="23:00">23:00</option>
                    <option value="23:30">23:30</option>
</select>
</td>
<td width="15%"><b>Abgabedatum:</b></td> <td width="15%"><input type="text" size="15" name="datum" /> (Format: dd.mm.YYYY)</td>
</tr>
</table>
<br />
<b><u>Sichtbar für:</u></b><br />
<table cellpadding="0" cellspacing="0" width="100%">
<tr valign="top">
<?php
require_once("database/connect.inc.php");
$i=0;
$faculty=mysql_query("SELECT * FROM faculty");
while($row_faculty=mysql_fetch_row($faculty)) {
	echo "<td width=\"50%\">";
	echo "<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">";
	echo "<tr valign=\"top\"><td><b>" . $row_faculty[1] . "</b></td></tr>";
	$studycourse=mysql_query("SELECT studycid, studycourse FROM studycourse WHERE facid=" . $row_faculty[0] . "");
	while($row_studycourse=mysql_fetch_row($studycourse)) {
		echo "<tr valign=\"top\"><td><input type=\"checkbox\" name=\"studycourse[]\" value=\"" . $row_faculty[0] . "." . $row_studycourse[0] . "\" />" . $row_studycourse[1] . "</td></tr>";
	}
	echo "</table><br /><br />";
	echo "</td>";
	$i++;
	if($i==2) {
		echo "</tr>";
		echo "<tr>";
		$i=0;
	}
}
require_once("database/disconnect.inc.php");
?>
</tr>
</table>
<input type="submit" name="submit" style="width:30%; height:30px; margin-right:5px; background-color:#41B367; color:#FFF; font-weight:bold; text-align:center; border-left:1px solid #FFF; 	border-top:1px solid #FFF; 	border-right:1px solid #FFF;" value="Projekt erstellen"> 




       
</div>
</div>

<?php
}
else {
	$_SESSION['message']="pwda";
	echo "<meta http-equiv=\"refresh\" content=\"0; URL=?key=login\">";
}
?>