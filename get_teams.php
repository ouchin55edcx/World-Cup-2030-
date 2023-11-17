<?php
// get_teams.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "woldcup_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['groupId'])) {
    $groupId = $_GET['groupId'];
    $sqlTeams = "SELECT * FROM Teams WHERE groupID = $groupId";
    $resultTeams = $conn->query($sqlTeams);

    $teams = array();

    if ($resultTeams->num_rows > 0) {
        while ($row = $resultTeams->fetch_assoc()) {
            $teams[] = $row;
        }
    }

    echo json_encode($teams);
}

$conn->close();
?>
