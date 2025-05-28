<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" >
<head>
<title>MySQL Databases with and PHP</title>
</head>

<body>
<?php
// that should be memberadd.php

// Include database credentials with correct path
require_once ("../../files/settings.php");
	
	// The @ operator suppresses the display of any error messages
	// mysqli_connect returns false if connection failed, otherwise a connection value
	$conn = @mysqli_connect($sql_host,
		$sql_user,
		$sql_pass,
		$sql_db
	);
  
	// Checks if connection is successful
	if (!$conn) 
	{
		// Displays an error message
		echo "<p>Database connection failure</p>";
		  exit;
	}

/* else {
		// Upon successful connection
		
		// Get data from the form
		$id1    = $_POST["id"];
        $make	= $_POST["make"];
		$model	= $_POST["model"];
		$price	= $_POST["price"];
		

		// Set up the SQL command to add the data into the table
		$query = "insert into $sql_tble"
						."(id, make, model, price)"
					. "values"
						."('$id1','$make','$model', $price)";
echo $query;*/


$fname = trim($_POST["fname"]);
$lname = trim($_POST["lname"]);
$gender = $_POST["gender"];
$email = trim($_POST["email"]);
$phone = trim($_POST["phone"]);


		// executes the query
		//$result = mysqli_query($conn, $query);
		// checks if the execution was successful
		if($fname == "" || $lname == "" || $gender == "" || $email == "" || $phone == "") 
		{
		   echo "<p>All fields are required. Please go back and complete the form.</p>";
                    mysqli_close($conn);
                    exit;
		} 

$insertQuery = "INSERT INTO vipmember (fname, lname, gender, email, phone)
                VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $insertQuery);
mysqli_stmt_bind_param($stmt, "sssss", $fname, $lname, $gender, $email, $phone);

if (mysqli_stmt_execute($stmt)) {
    echo "<p>New VIP member added</p>";
    echo "<a href='vip_member.php'>Return to Home Page</a>";
} else {
    echo "<p>Error" . mysqli_error($conn) . "</p>";
}

/*else {
			// display an operation successful message
			echo "<p>Success</p>";
		} // if successful query operation*/

		// close the database connection
               mysqli_stmt_close($stmt);
		mysqli_close($conn);
	}  // if successful database connection
?>
</body>
</html>




