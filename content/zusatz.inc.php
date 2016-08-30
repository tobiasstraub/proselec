<script type="text/javascript">
<?php
require_once("../database/connect.inc.php");
for($i=1; $i<=mysql_num_rows(mysql_query("SELECT * FROM studycourse WHERE facid='" . $_GET['facid'] . "'")); $i++) {
	$result=mysql_fetch_row(mysql_query("SELECT studycourse FROM studycourse WHERE studycid='" . $i . "' AND facid='" . $_GET['facid'] . "'")); ?>
	$("#studycourse").append("<option value='<?php echo $i; ?>'><?php echo $result[0]; ?></option>");
<?php
}
require_once("../database/disconnect.inc.php");
?>
</script>