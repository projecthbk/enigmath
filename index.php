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
		div { background: #cccccc; border-radius: 15px; margin: 10px auto; padding: 10px; }
		form { margin: 0; }
	</style>
</head>
<body>
	<center>
	<div style="width: 1100px;">
	<form>
		<label>FORMULA</label>
		<input type="text" style="width: 909px;" name="formula" value="<?php echo $_GET['formula']; ?>" placeholder="MATH FORMULA IN PYTHON SYNTAX" />
		<input type="submit" value="CHECK" />
	</form>
	</div>
	<?php
	if ($_GET['formula']!='') {
	$label=array();
	for ($n=1;$n<101;$n++) 
		$label[]=n;
	$labels = json_encode($label);
	$values = shell_exec('python3 enigtest.py "' . $_GET['formula'] . '"');
	}
	?>
	<div style="width: 500px;">
	<form action="coder.php" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="formula" value="<?php echo $_GET['formula']; ?>" />
		<input type="file" name="encfile" />
		<input type="submit" value="ENCODE/DECODE" />
	</form>
	</div>
	<div style="width: 1280px; height: 720px;"><canvas id="myChart" width="1280" height="720"></canvas></div>
	</center>
</body>
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
            text: "Encryption Data Chart"
        },
    }
});
</script>
</html>
