<?php
$Name = $_POST['Name'];
<<<<<<< HEAD
$Email    = $_POST['Email'];
=======
$Email = $_POST['Email'];
>>>>>>> 6d06678088a4733a80a5071c3f2adc383b7c7542
$Subject = $_POST['Subject'];
$Message = $_POST['Message'];

# Static variables

$Inifile = $_SERVER['DOCUMENT_ROOT'];
$Inifile .= "/php/Settings.ini";
$Settings = parse_ini_file($Inifile, true);

$Serverhostname = $Settings['Database']['Hostname'];
$Databasename   = $Settings['Database']['Database'];
$Databaseuser   = $Settings['Database']['Username'];
$Databasepass   = $Settings['Database']['Password'];

$Contact = $Settings['Tables']['Contact_table'];

# Connect to Server

$conn = new mysqli($Serverhostname, $Databaseuser, $Databasepass);

if($conn->connect_error) {
    die("connection failed: " . $conn->connect_error);
}

# Check if Database exists if not create it

$conn->query("CREATE DATABASE IF NOT EXISTS ${Databasename}");

# Check if Table exists if not create it

$conn = new mysqli($Serverhostname, $Databaseuser, $Databasepass, $Databasename);

$sql = "CREATE TABLE IF NOT EXISTS ${Contact} (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Name VARCHAR(255) NOT NULL,
Email VARCHAR(255) NOT NULL,
Subject VARCHAR(255) NOT NULL,
<<<<<<< HEAD
Message VARCHAR(400) NOT NULL,
Created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$conn->query($sql);
    $conn->query("INSERT INTO ${Contact} (Name, Email, Subject, Message) VALUES ('${Name}', '${Email}', '${Subject}', '${Message}') ");
  
    echo "<script>
		alert('Thank you for contacting us, we will get back to you on ${Email} soon!');
		window.history.go(-2);
	 </script>";
=======
Message text,
Created_on TIMESTAMP
)";

$conn->query($sql);

$conn->query("INSERT INTO ${Contact} (Name, Email, Subject, Message) VALUES ('${Name}', '${Email}', '${Subject}', '${Message}') ");
    echo "<script>
		alert('Thank you for contacting us, we will get back to you on ${Email} soon!');
		window.history.go(-2);
     </script>";

>>>>>>> 6d06678088a4733a80a5071c3f2adc383b7c7542
$conn->close();
?>