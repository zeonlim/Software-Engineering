<?php
	$connect = mysqli_connect("localhost","root","","database");


	if(!$connect)
		echo"error";
	else
		echo"conn";
?>