<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_logincon = "localhost";
$database_logincon = "cqwryore_centrorestohouseorderingsys";
$username_logincon = "root";
$password_logincon = "sql";

/*$hostname_logincon = "localhost";
$database_logincon = "cqwryore_centrorestohouseorderingsys";
$username_logincon = "cqwryore_root";
$password_logincon = "jaynikemae102";*/

$logincon = mysqli_connect($hostname_logincon, $username_logincon, $password_logincon) or trigger_error(mysqli_error(),E_USER_ERROR); 
?>