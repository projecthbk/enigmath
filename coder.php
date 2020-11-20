<?php
		ini_set('max_execution_time', 0);
		$filename=basename($_FILES['encfile']['name']);
		if (substr($filename,-9)=='.enigmath')
			$file = substr($filename,0,strlen($filename)-9) . '.original';
		else
			$file = $filename . '.enigmath';
		header('Content-Description: EnigMATH encoded file');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="' . $file . '"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		move_uploaded_file($_FILES['encfile']['tmp_name'],'TMP');
		shell_exec('python3 enigmath.py TMP "' . $_POST['formula'] . '"');
		while (filesize('TMP.enigmath')<$_FILES['encfile']['size']) sleep(1);
		readfile('TMP.enigmath');
		unlink('TMP.enigmath');
		unlink('TMP');
?>
