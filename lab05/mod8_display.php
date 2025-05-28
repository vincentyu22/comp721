<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" >
<head>
<title>MySQL Databases with PHP</title>
</head>

<body>
	<?php
	// sql info or use include 'file.inc'
require_once ("../../files/settings.php");


$conn = @mysqli_connect($sql_host,
		$sql_user,
		$sql_pass,
		$sql_db
	);
  
	// Checks if connection is successful
	if (!$conn) {
		// Displays an error message
		echo "<p>Database connection failure</p>";
	} else
	{ 
	$query = "SELECT car_id, make, model, price FROM car";
			
		// executes the query and store result into the result pointer
	$result = mysqli_query($conn, $query);
		
		// checks if the execuion was successful
		if(!$result) {
			echo "<p>Something is wrong with ". mysqli_error($conn) ."</p>";
		} elseif (mysqli_num_rows($result) > 0) 
		{
			 
			
			echo "<table>";
        echo "<tr><th>Car ID</th><th>Make</th><th>Model</th><th>Price ($)</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['car_id']}</td>";
            echo "<td>{$row['make']}</td>";
            echo "<td>{$row['model']}</td>";
            echo "<td>{$row['price']}</td>";
            echo "</tr>";
        }
			echo "</table>";
			
		} else 
{

echo "<p>no record found</p>";
}		
	 mysqli_close($conn);

?>
</body>
</html>



