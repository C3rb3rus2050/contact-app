<?php
$servername = "db";
$username = "user";
$password = "userpassword";
$dbname = "mydb";

$connected = false;
$tries = 0;

while (!$connected && $tries < 10) {
    try {
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_errno) {
            throw new Exception($conn->connect_error);
        }
        $connected = true;
    } catch (Exception $e) {
        $tries++;
        echo "Waiting for MySQL... attempt $tries<br>";
        sleep(3); // wait 3 seconds
    }
}

if (!$connected) {
    die("Could not connect to MySQL after several attempts.");
}
?>
