<?php

$server = 'localhost';
$username = 'root';
$password = '';
$dbname = 'openidtest';

$conn = mysql_connect($server, $username, $password);

mysql_select_db($dbname, $conn);

mysql_query( 'SET NAMES utf8', $conn );

//$sql  = "SELECT * FROM mydb.contact ";

//$result =  mysql_query( $sql, $conn );

?>