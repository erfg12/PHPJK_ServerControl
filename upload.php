<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>File Upload</title>
</head>

<body>
<?PHP if(!isset($_POST['submit'])) { echo '<p>Uploading to: ' . $_GET['f'].'</p>'; ?>
<form action="upload.php?f=<?PHP echo $_GET['f']; ?>" method="post" enctype="multipart/form-data">
    <p>Select file to upload: <input type="file" name="fileToUpload" id="fileToUpload"></p>
    <p><input type="checkbox" name="overwrite" value="true"> Overwrite Old File</p>
    <input type="button" style="color:red;" value="cancel" name="cancel" onClick="javascript:history.go(-1)"> <input type="submit" value="UPLOAD" style="color:green;font-weight:bold;" name="submit">
</form>
<?PHP 
} else {
	$target_file = "$_GET[f]/" . basename($_FILES["fileToUpload"]["name"]);
	if (!isset($_POST['overwrite'])){
		if (file_exists($target_file)) {
			echo 'File exists! Cant upload.';
			exit();
		}
	}
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    else
        echo "Sorry, there was an error uploading your file.";
} ?>
</body>
</html>
