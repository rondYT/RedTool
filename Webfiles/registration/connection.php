<?php
$Username = $_POST['Username'];
$Email    = $_POST['Email'];
$Password = $_POST['Password'];

# Static variables

$Inifile = $_SERVER['DOCUMENT_ROOT'];
$Inifile .= "/files/Settings.ini";
$Settings = parse_ini_file($Inifile, true);

$Serverhostname = $Settings['Database']['Hostname'];
$Databaseuser   = $Settings['Database']['Username'];
$Databasepass   = $Settings['Database']['Password'];
$Databasename   = $Settings['Database']['Database'];

$Adminuser = $Settings['Admin']['Username'];
$Adminpass = $Settings['Admin']['Password'];

$Usertable = $Settings['Tables']['Usertable'];

# Connect to Server

$conn = new mysqli($Serverhostname, $Databaseuser, $Databasepass);

if($conn->connect_error) {
    die("connection failed: " . $conn->connect_error);
}

# Check if Database exists if not create it

$conn->query("CREATE DATABASE IF NOT EXISTS ${Databasename}");

# Check if Table exists if not create it

$conn = new mysqli($Serverhostname, $Databaseuser, $Databasepass, $Databasename);

$sql = "CREATE TABLE IF NOT EXISTS ${Usertable} (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Username VARCHAR(255) NOT NULL,
Password VARCHAR(255) NOT NULL,
Betastatus VARCHAR(1) NOT NULL,
Email VARCHAR(255) NOT NULL,
Expires VARCHAR(255),
Updated TIMESTAMP
)";

$conn->query($sql);

# Calculate results

if ($conn->query("SELECT * FROM ${Usertable} WHERE Username = '${Username}'")->num_rows >= 1) {
    echo "<script>
		alert('Sorry account ${Username} already exists.');
		window.history.go(-1);
	 </script>";
}
elseif ($conn->query("SELECT * FROM ${Usertable} WHERE Email = '${Email}'")->num_rows >= 1) {
        echo "<script>
		alert('Sorry Email: ${Email} is alreay registered.');
		window.history.go(-1);
	 </script>";
}
else {
    $conn->query("INSERT INTO ${Usertable} (Username, Password, Email, Betastatus, Expires) VALUES ('${Username}', '${Password}', '${Email}', '0', '0') ");
  
    echo "<script>
		alert('You are registered. Your Username is: ${Username}.');
		window.history.go(-2);
	 </script>";
}

# Close our connection

$conn->close();

?>

