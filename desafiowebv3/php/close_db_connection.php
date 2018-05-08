<?php
//close the connection
/*mysql_close($dbhandle);*/

$conn->close();

echo "<!--Disconnected from MySQL database " . $db_name . "-->";
?>