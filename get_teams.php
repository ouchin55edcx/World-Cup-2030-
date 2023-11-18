<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "worldcup";

// Check if group_id is set in the URL
if (isset($_GET['group_id'])) {
    $groupId = $_GET['group_id'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statement to prevent SQL injection
    $sql = "SELECT team_name, logo_img FROM teams WHERE group_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $groupId); // "i" represents an integer

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Output data as JSON
    $teamsData = array();
    while ($row = $result->fetch_assoc()) {
        $teamsData[] = $row;
    }

    echo json_encode($teamsData);

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

