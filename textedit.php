<?PHP
if (isset($_POST['save'])) {
	file_put_contents("$_GET[f]","$_POST[config_data]");
	header('Location: '.$_SERVER['PHP_SELF'].'?f='.$_GET['f']);
} else {
?>
<form method="post">
<textarea name="config_data" style="width:100%;min-width:400px;height:90%;min-height:400px;"><?PHP echo file_get_contents("$_GET[f]"); ?></textarea>
<button type="submit" name="save" style="font-size:21;font-weight:bold;background-color:green;margin-top:5px;">SAVE FILE</button> Stop and start server to reflect new settings. <a href="Javascript:history.back()">Go Back</a>
</form>
<?PHP } ?>