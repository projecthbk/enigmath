<?php
		ini_set('max_execution_time', 0);
		if ($_FILES['encfile']['size']>1048576) {
			echo '<meta http-equiv="refresh" content="3;url=./?formula=' . urlencode($_POST['formula']) . '" /><center>MAX FILESIZE: 1024kB</center>';
			exit();
		}
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
		$filename = 'tmp' . strval(rand(1000,9999));
		move_uploaded_file($_FILES['encfile']['tmp_name'],$filename);
		shell_exec('python3 enigmath.py ' . $filename . ' "' . $_POST['formula'] . '"');
		while (filesize($filename . '.enigmath')<$_FILES['encfile']['size']) sleep(1);
		readfile($filename . '.enigmath');
		foreach(glob($filename . "*") as $f) unlink($f);
}
?>
