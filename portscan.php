<?php
if (isset($_GET['background'])) {
	$data='iVBORw0KGgoAAAANSUhEUgAAAAkAAACBCAMAAAAlrGCXAAABHVBMVEX+//+21+HI4enJ4um32OLL4+q42eK52eO62uO72uO82+S92+S+3OW/3OX4+/zT5+36/P3n8vX8/f7p8/b9/v7E3+fs9ffG4Oju9vj3+/z5/P3w9/nN5Ov7/f31+vvh7/Pr9Pf2+vu22OLO5OvP5evA3eW22OG42OLA3ebC3ubW6e/D3+fY6u/M4+rZ6/Da6/Db6/Db7PHK4und7PHe7fHe7fLf7vLg7vLP5ezi7/Pj8PPj8PTk8PTl8fTB3ebm8vXB3ubo8/bD3ufq9PfZ6u/F4Oft9fjH4ejv9vnc7PHx9/nx+Pny+Prz+Prz+fr0+fr0+fvQ5uzR5uzR5u3S5+3l8fXU6O7V6O7W6e78/v7X6u/+/v7+/v/+//+11+Fjq/ADAAAAAXRSTlNVW+d9HQAAAM5JREFUeF5NxkN2AAAABbGpbdu2bdvG/Y/R1fT9rMKvYgWKjYpBUazYmChVrEyxcsUqFKtUrEqxasVqFBsR42JX7IsJcSimRItiJ6JNsTNRqFiRYouiRLEZ0a3YkBgW6+JBPIon8SzqFHsVb+JdTIpPMS2OxayYE/NiQVyIJbEsVsSqWBN9im2ITbEltsWOeBF7okGxA9Gk2JHoV6xVsVPRrti56FLsUlyJa3EjbsWduBe9ig0o1qFYrWKditUr1qNYo2IfolmxL/EtfoT4A/T3tAHt+O7JAAAAAElFTkSuQmCC';
	header('Content-type: image/png');
	echo base64_decode($data);
	exit;
} elseif (isset($_GET['check'])) {
	$data = 'iVBORw0KGgoAAAANSUhEUgAAABAAAAAQBAMAAADt3eJSAAAAElBMVEX///9pzBiN4hZnrWqN4hZpzBhti42CAAAABHRSTlMA5+mZGVHD+gAAAEhJREFUeF59ysERwBAUhOGXlwYEDcgkd0pg6ID+W2EfV/7LznyztEutZbfgTZP4g1yKdAZo9/zRD7G5VYNDKE2AbgsQAggBTnWN9AXGF+1NVQAAAABJRU5ErkJggg==';
	header('Content-type: image/png');
	echo base64_decode($data);
	exit;
} elseif (isset($_GET['x'])) {
	$data = 'iVBORw0KGgoAAAANSUhEUgAAABAAAAAQBAMAAADt3eJSAAAAMFBMVEX////95s7/6tD/kxD/hhj/dRD/pBj6zpj+iyT9mSD/eyD/kgD/jQD/eQD/bgD/iAAU7YmcAAAAC3RSTlMAMjDv5+/naNvf3128OkwAAABuSURBVHhefcmhDYUwFIXh25JAcDXPk3SQpiOwAAKBwhE2YAI2eHMgGQBTAuZKDKIb3JTbasJRX/4DLxOTgt+fUaIVzc3IyI3+YkiD6GsGaMJdRRQBD0glkItF9ltAy8iXdSCX0EpzxqurQM/wsQcOmx5MHBczMwAAAABJRU5ErkJggg==';
	header('Content-type: image/png');
	echo base64_decode($data);
	exit;
}
$path = $_SERVER['PHP_SELF'];

function check_port($port) {
	$conn = @fsockopen('127.0.0.1', $port, $errno, $errstr, 0.2);
	if ($conn) {
		fclose($conn);
		return true;
	}
}

$report = array();
$svcs = array(
				'21'	=> 'FTP',
				'22'	=> 'SSH',
				'23'	=> 'Telnet',
				'25'	=> 'SMTP',
				'53'	=> 'DNS',
				'70'	=> 'Gopher',
				'80'	=> 'HTTP',
				'110'	=> 'POP3',
				'143'	=> 'IMAP',
				'443'	=> 'HTTPS',
				'873'	=> 'Rsync',
				'3306'	=> 'MySQL',
				'5432'	=> 'PostgreSQL',
				);
foreach ($svcs as $port=>$service)
	$report[$service] = check_port($port);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<title>Port Scan Summary</title>
	<style type="text/css">
		body {
			font:14px/1.4em "Lucida Grande", Verdana, Arial, Helvetica, Clean, Sans, sans-serif;
			letter-spacing:0px;
			color:#333;
			margin:0;
			padding:0;
			background:#fff url(<?php echo $path?>?background) repeat-x top left;
		}
		
		div#site {
			width:550px;
			margin:20px auto 0 auto;
		}
		
		a {
			color:#000;
			text-decoration:underline;
			padding:0 1px;
		}
		
		a:hover {
			color:#fff;
			background-color:#333;
			text-decoration:none;
			padding:0 1px;
		}
		
		p {
			margin:0;
			padding:5px 0;
		}
		
		em {
			font-style:normal;
			background-color:#ffc;
		}
		
		ul, ol {
			margin:10px 0 10px 20px;
			padding:0 0 0 15px;
		}
		
		ul li, ol li {
			margin:0 0 7px 0;
			padding:0 0 0 3px;
		}
		
		h2 {
			font-size:18px;
			padding:0;
			margin:30px 0 10px 0;
		}
		
		h3 {
			font-size:16px;
			padding:0;
			margin:20px 0 5px 0;
		}
		
		h4 {
			font-size:14px;
			padding:0;
			margin:15px 0 5px 0;
		}
		
		code {
			font-size:1.1em;
			background-color:#f3f3ff;
			color:#000;
		}
		
		em strong {
		    text-transform: uppercase;
		}
		
		table#chart {
			border-collapse:collapse;
		}
		
		table#chart th {
			background-color:#eee;
			padding:2px 3px;
			border:1px solid #fff;
		}
		
		table#chart td {
			text-align:center;
			padding:2px 3px;
			border:1px solid #eee;
		}
		
		table#chart tr.enabled td {
			/* Leave this alone */
		}
		
		table#chart tr.disabled td, 
		table#chart tr.disabled td a {
			color:#999;
			font-style:italic;
		}
		
		table#chart tr.disabled td a {
			text-decoration:underline;
		}
		
		div.chunk {
			margin:20px 0 0 0;
			padding:0 0 10px 0;
			border-bottom:1px solid #ccc;
		}
		
		.footnote,
		.footnote a {
			font:10px/12px verdana, sans-serif;
			color:#aaa;
		}
		
		.footnote em {
			background-color:transparent;
			font-style:italic;
		}
		</style>
		
	<script type="text/javascript">
		// Sleight - Alpha transparency PNG's in Internet Explorer 5.5/6.0
		// (c) 2001, Aaron Boodman; http://www.youngpup.net
		
		if (navigator.platform == "Win32" && navigator.appName == "Microsoft Internet Explorer" && window.attachEvent) {
			document.writeln('<style type="text/css">img, input.image { visibility:hidden; } </style>');
			window.attachEvent("onload", fnLoadPngs);
		}
		
		function fnLoadPngs() {
			var rslt = navigator.appVersion.match(/MSIE (\d+\.\d+)/, '');
			var itsAllGood = (rslt != null && Number(rslt[1]) >= 5.5);
		
			for (var i = document.images.length - 1, img = null; (img = document.images[i]); i--) {
				if (itsAllGood && img.src.match(/\png$/i) != null) {
					var src = img.src;
					var div = document.createElement("DIV");
					div.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + src + "', sizing='scale')";
					div.style.width = img.width + "px";
					div.style.height = img.height + "px";
					img.replaceNode(div);
				}
				img.style.visibility = "visible";
			}
		}
	</script>
</head>
<body>
<div id="site">
	<div id="content">
		<div class="chunk">
			<h2 style="text-align:center;">Port Scan Summary</h2>
			<table cellpadding="0" cellspacing="0" border="0" width="100%" id="chart">
				<thead>
					<tr>
						<th>Service</td>
						<th>Status</td>
					</tr>
				</thead>
				<tbody>
<?php

foreach ($report as $svc => $stat) {
	if ($stat) {
		echo <<<EOD
				<tr class="enabled">
					<td>$svc</td>
					<td><img src="$path?check" alt="./">Online</td>
				</tr>

EOD;
	} else {
		echo <<<EOD
				<tr class="disabled">
					<td>$svc</td>
					<td><img src="$path?x" alt="X">Offline</td>
				</tr>

EOD;
	}
}
?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</body>
</html>