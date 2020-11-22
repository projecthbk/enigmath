<?php
		$filename=basename($_FILES['encfile']['name']);
		if ($filename=='') {
			echo '<meta http-equiv="refresh" content="3;url=./?formula=' . urlencode($_POST['formula']) . '" /><center>ENIGMATH: File not uploaded properly. Allowed size up to 1GB.</center>';
			exit();
		}
		if (file_exists('.lock')) {
			echo '<meta http-equiv="refresh" content="3;url=./?formula=' . urlencode($_POST['formula']) . '" /><center>ENIGMATH: System is now processing another task. Try again later.</center>';
			exit();
		}
		
		if ($_FILES['encfile']['size']>3*1024*1024 || substr($filename,-4)=='.zip') {
			if (substr($filename,-13)=='.enigmath.zip') {
				$file = substr($filename,0,strlen($filename)-13) . '.original.zip';
				$type = 'unpack';
			} else { 
				if (substr($filename,-4)=='.zip') {
					$zip = substr($filename,0,strlen($filename)-(strlen(explode('.',$filename)[count(explode('.',$filename))-1])+1));
					$file = $zip . '.enigmath.zip';
				} else { 
					$zip = $filename;
					$file = $filename . '.enigmath.zip';
				}
				$type = 'pack';
			}
		} else {
			if (substr($filename,-9)=='.enigmath')
				$file = substr($filename,0,strlen($filename)-9) . '.original';
			else
				$file = $filename . '.enigmath';
			$type = 'encode';
		}
		header('Content-Description: EnigMATH Encoded File');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="' . $file . '"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		if ($type=='pack') {
			$filename = basename($_FILES['encfile']['name']);
			move_uploaded_file($_FILES['encfile']['tmp_name'],$filename);
			shell_exec('python3 enigmathize.py "' . $zip . '" "' . $filename . '" "' . $_POST['formula'] . '"');
			while (file_exists('.lock')) sleep(1);
			readfile($zip . '.enigmath.zip');
			unlink($filename);
			unlink($zip . '.enigmath.zip');
		} elseif ($type=='unpack') {
			$filename = basename($_FILES['encfile']['name']);
			move_uploaded_file($_FILES['encfile']['tmp_name'],$filename);
			shell_exec('python3 enigmathize.py "' . $filename . '" "' . $_POST['formula'] . '"');
			while (file_exists('.lock')) sleep(1);
			readfile(substr($filename,0,strlen($filename)-13) . '.original.zip');
			unlink($filename);
			unlink(substr($filename,0,strlen($filename)-13) . '.original.zip');
		} elseif ($type=='encode') {
			$filename = 'tmp' . rand(1000,9999);
			move_uploaded_file($_FILES['encfile']['tmp_name'],$filename);
			shell_exec('python3 enigmath.py "' . $filename . '" "' . $_POST['formula'] . '"');
			while (filesize($filename . '.enigmath')<$_FILES['encfile']['size']) sleep(1);
			readfile($filename . '.enigmath');
			unlink($filename);
			unlink($filename . '.enigmath');
		} 
?>
