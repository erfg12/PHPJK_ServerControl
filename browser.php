<?PHP include("include.php"); ?>
<body>
<div style="width:100%;height:15px;"></div>
<?PHP
// Explore the files via a web interface.
$script = basename(__FILE__); // the name of this script
$path   = !empty($_REQUEST['path']) ? $_REQUEST['path'] : dirname(__FILE__); // the path the script should access
if (isset($_REQUEST['unlink']))
	$unlink = $_REQUEST['unlink'];

if(!empty($unlink)){
	$unlink = realpath("$path/$unlink");
	if(is_writable($unlink) && !unlink($unlink)){
		echo "<div class=\"error\">Unable to delete file: $unlink</div>";
	}
}
?>
<div class="container">
	<?PHP echo "<div style=\"width:100%;\"><div style=\"float:left;border:thin solid gray;padding:2px;\">{$path}</div><a href=\"upload.php?f=$_GET[path]\"><div style=\"float:right;border:thin solid gray;border-radius:5px;padding:5px;font-weight:bold;background-color:#F4EDE3\">File Upload</div></a></div>";  ?>         
	<table class="table">
    	<thead>
      		<tr>
        		<th>File</th>
        		<th>Writable</th>
        		<th>Delete</th>
      		</tr>
    	</thead>
    <tbody>
	<?PHP
	$directories = array();
	$files       = array();

	// Check we are focused on a dir
	if (is_dir($path)){
    	chdir($path); // Focus on the dir
    	if ($handle = opendir('.')){
      		while (($item = readdir($handle)) !== false) {
        		// Loop through current directory and divide files and directorys
        		if(is_dir($item))
          			array_push($directories, realpath($item));
        		else
          			array_push($files, ($item));
      		}
      		closedir($handle); // Close the directory handle
		}
		else
			echo "<p class=\"error\">Directory handle could not be obtained.</p>";
	}
	else
    	echo "<p class=\"error\">Path is not a directory</p>";

	// List the directories as browsable navigation
	foreach($directories as $directory){
		$skip = false;
		if ($directory == $path)
			continue;
		$icon = 'glyphicon-folder-open';
		if (strpos($_GET['path'],'/'.basename($directory).'/')){
			$icon = 'glyphicon-folder-close';
			$skip = true;
		}
		echo '<tr><td>';
    	echo "<a href=\"{$script}?path={$directory}\"><span class=\"glyphicon ".$icon."\" style=\"margin-right:5px;\"></span>".basename($directory)."</a>";
		echo "</td><td>";
		echo "</td><td></td>";
		echo '</tr>';
		if ($skip)
			echo '<tr><td></td><td></td><td></td></tr>';
	}
  
	foreach($files as $file){
		echo '<tr>';
   	 	// Comment the next line out if you wish see hidden files while browsing
    	if(preg_match("/^\./", $file) || $file == $script){continue;} // This line will hide all invisible files.

		echo '<td>';
		$modifier = 'download';
		$icon = 'glyphicon-book';
		if (strpos(basename($file),'.cfg') || strpos(basename($file),'.txt') || strpos(basename($file),'.sh')){
			$modifier = 'textedit';
			$icon = 'glyphicon-text-background';
		}
		if (strpos(basename($file),'.ico') || strpos(basename($file),'.png') || strpos(basename($file),'.jpg') || strpos(basename($file),'.git')){
			$icon = 'glyphicon-picture';
		}
		echo '<a href="'.$modifier.'.php?f=' . $_GET['path'] . '/' . basename($file) . '"><span class="glyphicon '.$icon.'" style="margin-right:5px;"></span>' . $file . "</a>";
		echo '</td><td>';
		if (is_writable($file)) echo '<span style="color:green;">Y</span>'; else echo '<span style="color:red;">N</span>';
		echo '</td>';
		echo is_writable($file) ? "<td><a class=\"unlink\" href=\"{$script}?path={$path}&unlink={$file}\">delete</a></td>" : '<td></td>';
		echo '</tr>';
	}
	?>

	</tbody>
</table>
</div>

</body>
</html>