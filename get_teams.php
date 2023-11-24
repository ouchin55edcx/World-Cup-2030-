<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "worldcup";

if (isset($_GET['group_id'])) {
    $groupId = $_GET['group_id'];

    $conn = new mysqli($servername, $username, $password, $dbname);
    
    $sql = "SELECT team_name, logo_img FROM teams WHERE group_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $groupId); 

    $stmt->execute();

    $result = $stmt->get_result();

    $teamsData = array();
    while ($row = $result->fetch_assoc()) {
        $teamsData[] = array(
            'team_name' => $row['team_name'],
            'logo_img' => $row['logo_img']
        );
    }

    echo json_encode($teamsData);

    $stmt->close();
    $conn->close();
}
?>
