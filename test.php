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
            // Output HTML for each team
            echo "<div class='team'>";
            if (!empty($row['logoImage'])) {
                echo "<img src='{$row['logoImage']}' alt='Team Logo' style='width: 50px; height: 50px;'>";
            }
            echo "<p>{$row['teamName']}</p>";
            echo "</div>";

            // Optionally, you can store team data in an array for further use
            $teams[] = $row;
        }
    }

    // Optionally, you can return the teams as JSON
    // echo json_encode($teams);
}

$conn->close();
?>
