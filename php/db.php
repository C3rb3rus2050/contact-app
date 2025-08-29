<?php
$servername = "db";
$username = "user";
$password = "userpassword";
$dbname = "mydb";

// Retry connection to handle MySQL startup delay
$connected = false;
$tries = 0;

while (!$connected && $tries < 10) {
    try {
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_errno) throw new Exception($conn->connect_error);
        $connected = true;
    } catch (Exception $e) {
        $tries++;
        sleep(3);
    }
}

if (!$connected) die("Could not connect to MySQL after several attempts.");
?>
