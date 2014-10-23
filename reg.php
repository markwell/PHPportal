<?php
	$connect = mysql_connect('localhost','root','') or die(mysql_error());
	mysql_select_db('test');

	$mail = '';
	$password = '';
	$repassword = '';
	if (true || isset($POST['submit'])) {
		echo '1';
		$mail=strval($_POST['email']);
		$password=strval($_POST['pass']);
		$repassword = strval($_POST['repass']);
	}
	if ($password == $repassword) {
		$password = md5($password);
		$query = mysql_query ("INSERT INTO users VALUES (NULL,'".$mail."','".$password."')") or die(mysql_error());
		//echo "INSERT INTO users VALUES (NULL,'".$mail."','".$password."')";
	}
	else {
		die('password must mutch!'); 
} 
?>