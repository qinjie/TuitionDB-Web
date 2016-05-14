<?php
	echo "<h2>Generate Password Hash </h2>";
	$password = 'abc123';
	$hash = password_hash($password, 1);
	echo "password: " . $password;
	echo "<br>";
	echo "hashed: " . $hash;
	
	echo "<br>";
	echo strtotime('now');
	echo "<br>";
	echo time();
	echo "<br>";
	echo date('Y-m-d H:i:s', time());
	echo "<br>";
	echo date('Y-m-d H:i:s', strtotime("+2 day"));
	echo "<br>";
	echo date('Y-m-d H:i:s', strtotime("+2 day", strtotime('2014-01-01 01:23:45')));
	
	echo phpinfo();	
?>