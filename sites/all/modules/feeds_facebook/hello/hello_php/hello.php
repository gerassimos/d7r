<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
 <?php echo '<p>Hello World</p>'; ?> 

<?php echo $_SERVER['HTTP_USER_AGENT']; ?>


<?php echo $_SERVER['HTTP_USER_AGENT'];
if(strpos($_SERVER['HTTP_USER_AGENT'],'MSIE') ){
	echo 'ie exporer';
}else{
	echo 'NO ie exporer';
} 

$a_var="tets";


define('TIPEPRICE', 10);
echo TIPEPRICE;

$a_var2= @(50/0);
echo "<br>";
$out=`ls -lh`;
echo $out;
echo "<br>";
echo "<br>";

$a_var3=10;
settype($a_var3, 'double');
echo "a_var3 type is: ".gettype($a_var3);



?>
 </body>
</html>
