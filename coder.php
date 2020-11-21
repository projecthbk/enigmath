<?php
		$filename=basename($_FILES['encfile']['name']);
		if ($filename=='') {
			echo '<meta http-equiv="refresh" content="3;url=./?formula=' . urlencode($_POST['formula']) . '" /><center>ENIGMATH: File not uploaded properly. Allowed size up to 1GB.</center>';
			exit();
		}
		if ($_FILES['encfile']['size']>1048576) {
			if (substr($filename,-13)=='.enigmath.zip') {
				echo '<meta http-equiv="refresh" content="3;url=./?formula=' . urlencode($_POST['formula']) . '" /><center>ENIGMATH: To unpack "enigmath.zip" file open archive and decode "password.enigmath".</center>';
				exit();
			} else
				$file = explode('.',$filename)[0] . '.enigmath.zip';
		} else {
			if (substr($filename,-9)=='.enigmath')
				$file = substr($filename,0,strlen($filename)-9) . '.original';
			else
				$file = $filename . '.enigmath';
		}
		header('Content-Description: EnigMATH Encoded File');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="' . $file . '"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		$filename = 'tmp' . rand(1000,9999);
		move_uploaded_file($_FILES['encfile']['tmp_name'],$filename);
		if ($_FILES['encfile']['size']>1048576) {
			shell_exec('python3 enigmathize.py ' . explode('.',$file)[0] . ' ' . $filename . ' "' . $_POST['formula'] . '"');
			while (filesize(explode('.',$file)[0] . '.enigmath.zip')<=filesize(explode('.',$file)[0] . '.zip')) sleep(1);
			readfile(explode('.',$file)[0] . '.enigmath.zip');
			unlink($filename);
			unlink(explode('.',$file)[0] . '.enigmath.zip');
		}
		else {
			shell_exec('python3 enigmath.py ' . $filename . ' "' . $_POST['formula'] . '"');
			while (filesize($filename . '.enigmath')<$_FILES['encfile']['size']) sleep(1);
			readfile($filename . '.enigmath');
			unlink($filename);
			unlink($filename . '.enigmath');
		}		
?>
