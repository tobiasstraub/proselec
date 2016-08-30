<?php
if(isset($_SESSION['lecturer']) && $_SESSION['lecturer']) {
	
require_once("../database/connect.inc.php");

if(isset($_POST['submit'])) {
  mysql_query("INSERT INTO project VALUES('','" . $_POST['prjtitle'] . "','" . $_POST['content'] . "','','','" . $_SESSION['lecturer_id'] . "')");
  header("Location: index.php?key=lecturer_backend");
  exit();
}

require_once("../database/disconnect.inc.php");
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

<form action="lecturer_backend/addproject.inc.php" method="post">
<br />
<p><b><font size="+1">Projekttitel:</font></b> <input type="text" size="60" name="prjtitle" /></p>
<br /><br /> 
<textarea name="content" style="width:100%; height:350px"> Hier k&ouml;nnen Sie ihre Projektebeschreibung eintragen.</textarea><br /> 
<input type="submit" name="submit" style="width:15%; height:25px; margin-right:5px; background-color:#41B367; color:#FFF; font-weight:bold; text-align:center; border-left:1px solid #FFF; 	border-top:1px solid #FFF; 	border-right:1px solid #FFF;" value="Projekt erstellen"> 

       
</div>
</div>

<?php
}
else {
	$_SESSION['message']="pwda";
	echo "<meta http-equiv=\"refresh\" content=\"0; URL=?key=login\">";
}
?>