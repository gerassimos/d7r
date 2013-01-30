<html>
<head>
<title>PHP Test</title>
</head>
<body>

	<?php echo '<p>Hello World</p>'; ?>




	<?php 
	
	echo "DOCUMENT_ROOT: ". $_SERVER['DOCUMENT_ROOT'];
	echo "<br>";
	$path = $_SERVER['DOCUMENT_ROOT'] . "/site/hello_php/orders.txt";
	echo "paht: ". $path;
	
	$fp = fopen($path, 'w');
	
	if($fp){
		echo 'file opened ';
	}else {
		echo 'file NOT opened ';
	}
	
	echo '<br>test include <br> ';
	include 'test_date.myext';




	?>





</body>
</html>
