<!--file data.php -->
<?php
	
header ('Content-Type: spplication/json')
$db_host = 'webdev.aut.ac.nz';
$db_user = 'ync5389';          // Change to your MySQL username
$db_pass = 'ydadurzgsufoivatseaizakokzwbcrme';              // Change to your MySQL password
$db_name = 'ync5389';

$conn = new mysqli($db_host,$db_user,$db_pass, $db_name);


if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed."]);
    exit();
}
// get name and password passed from client
	$name = $_GET['name'];
	$pwd = $_GET['pwd'];

$stmt =$conn-> prepare("SELECT password, email FROM user Where name = ?");
$stmt ->bind_param("s",$name);
$stmt ->execute();
$result =$stmt->get_result();


if ($row = $result->fetch_assoc()) {
    if ($row['password'] === $pwd) {
        echo json_encode([
            "status" => "ok",
            "email" => $row['email'],
            "name" => $name
        ]);} else {echo json_encode([
"status" => "error",
"message" => "Incorrect password for user: " . htmlspecialchars($name)
        ]);
    }
} else { echo json_encode([
        "status" => "error",
        "message" => "No user found with name: " . htmlspecialchars($name)   ]);}

// sleep for 10 seconds to slow server response down
	// sleep(10);
	// write back the password concatenated to end of the name
	//ECHO ($name." : ".$pwd)


$stmt->close();
$conn->close();
?>
