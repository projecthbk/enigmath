<!--
     Author: Krzysztof Hrybacz <krzysztof@zygtech.pl>
     License: GNU General Public License -- version 3
-->

<html>
<head>
	<title>EnigMATH</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />
	<style>
		body { font-family: serif; font-size: 16; }
		input,label { font-family: sans-serif; font-size: 14px; }
		a { text-decoration: none; color: #000000; }
		a:hover { text-decoration: underline; }
		div { width: 500px; background: #cccccc; border-radius: 15px; margin: 5px auto; padding: 10px; font-family: sans-serif; font-size: 14px; }
		input[type="text"],input[type="file"] { width: 300px; }
		form,h1 { margin: 0; }
	</style>
</head>
<body>
	<center>
	<h1><a href="https://github.com/projecthbk/enigmath" target="_BLANK">EnigMATH</a></h1>
	<div>
	<form>
		<label>FORMULA</label>
		<input type="text" name="formula" value="<?php echo $_GET['formula']; ?>" placeholder="MATH FORMULA IN PYTHON SYNTAX" />
		<input type="submit" value="PLOT" />
	</form>
	</div>
	<?php
	if ($_GET['formula']!='') {;
		$values = shell_exec('python3 enigtest.py "' . $_GET['formula'] . '"');
		$count = count(explode(',',$values));
		$label=array();
		for ($n=1;$n<=$count;$n++) 
			$label[]=n;
		$labels = json_encode($label);
		if (substr($values,0,11)=='MATH ENIGMA') {
			echo '<div>' . str_ireplace("\n",'<br />',$values) . '</div></body></html>';
			exit();
		} else if ($values=='') {
			echo '<div>MATH ENIGMA TESTER: Create your own any "enrypting machine".<br />Something went wrong with formula. Check syntax.</div></body></html>';
			exit();
		}
	?>
	<div>
	<form action="coder.php" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="formula" value="<?php echo $_GET['formula']; ?>" />
		<input type="file" name="encfile" />
		<input type="submit" value="ENCODE/DECODE" />
	</form>
	</div>
	<div style="width: 1280px; height: 720px;"><canvas id="myChart" width="1280" height="720"></canvas></div>
	</center>
<script>
var ctx = document.getElementById('myChart');
var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
		labels:  <?php echo $labels; ?>,
		datasets: [{ 
			label: "Value",
			borderColor: 'rgb(255, 0, 0)',
			borderWidth: 1,
			data: <?php echo $values; ?>
		}]
	},
    options: {
		responsive: true,
		maintainAspectRatio: false,
		legend: {
			position: 'bottom',
		},
        title: {
            display: true,
            text: "Encryption Data Plot"
        },
        legend: {
			display: false
		},
		tooltips: {
            enabled: false
		}
    }
});
</script>
<?php
	}
?>
</body>
</html>
