<?php
$username = "challengeWebCERN";
$password = "pwd";
$hostname = "localhost";
$db_name = "db_challengeWebCERN";

/*//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password)
  or die("Unable to connect to MySQL");

$selected = mysql_select_db($db_name,$dbhandle)
or die("Could not select " + $db_name);
*/

// Create connection
$conn = new mysqli($hostname, $username, $password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "<!--Connected to MySQL database " . $db_name . "-->";

?>
