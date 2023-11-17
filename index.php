<!-- http://localhost/world-cup/ -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Data</title>
    <!-- <link rel="stylesheet" href="style.css"> -->

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .topnav {
            display: flex;
            justify-content: space-between;
            overflow: hidden;
            background-color: #610C9F;
        }

        .topnav a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;

        }

        .topnav a.active {
            /* background-color: #04AA6D; */
            color: white;
        }

        .topnav .icon {
            display: none;
        }

        @media screen and (max-width: 600px) {
            .topnav a:not(:first-child) {
                display: none;
            }

            .topnav a.icon {
                float: right;
                display: block;
            }
        }

        @media screen and (max-width: 600px) {
            .topnav.responsive {
                position: relative;
            }

            .topnav.responsive .icon {
                position: absolute;
                right: 0;
                top: 0;
            }

            .topnav.responsive a {
                float: none;
                display: block;
                text-align: left;
            }
        }







        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .card-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(2, 1fr);
            grid-column-gap: 100px;
            grid-row-gap: 20px;
            padding: 20px;
            height: 100vh;

        }

        .card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            background-image: url('R.jpeg');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            position: relative;
        }

        .card::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: rgba(0, 0, 0, 0.5);
            /* Adjust the background color and opacity as needed */
            border-radius: 5px;
        }

        .card h3,
        .card p {
            margin: 0;
            z-index: 1;
        }

        .card h3 {
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 1em;
        }

        /* Additional styling for overlay */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 100;
        }

        #popup {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        #popup button {
            margin-top: 10px;
            padding: 8px 16px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        #popup button:hover {
            background-color: #555;
        }

    </style>
</head>

<body>
    <div class="topnav" id="myTopnav">
        <a href="#home" class="active" style="font-weight: 900; font-size:20px;
">World Cup 2030</a>
        <div>
            <a href="#">News</a>
            <a href="#">Teams</a>
            <a href="#">Players</a>

        </div>

        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        </a>
    </div>

    <div class="content">
        <div class="para">
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Aliquam iste velit natus corporis? Quisquam, reiciendis quos.
                Nisi, eius repudiandae et, ratione porro similique nesciunt
                eveniet amet cum doloremque dignissimos quisquam?
            </p>
        </div>

        <div class="content-img">
            <img src="FIFA-Highlights-FWC-2022.webp" alt="">
        </div>
    </div>

    <div class="card-container">
        <?php
        // Your existing PHP code to connect to the database and retrieve data...
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "woldcup_db";
        $port = "3306";

        $conn = mysqli_connect($servername, $username, $password, $dbname, $port);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Display data from the Groups table in cards
        $sqlGroups = "SELECT * FROM Groups";
        $resultGroups = $conn->query($sqlGroups);

        if ($resultGroups->num_rows > 0) {
            while ($row = $resultGroups->fetch_assoc()) {
                // Output HTML for each group card
                echo "<div class='card' onclick='showTeamPopup({$row['id']})'>";
                echo "<h3>{$row['Name']}</h3>";
                // Check if stadiumImage is set and not empty
                if (!empty($row['stadiumImage'])) {
                    echo "<img src='{$row['stadiumImage']}' alt='Stadium Image' style='width: 100%; max-height: 150px; object-fit: cover;'>";
                }
                echo "<p>Stadium: {$row['stadiumName']}</p>";
                echo "</div>";
            }
        } else {
            echo "No data found in Groups table";
        }

        // Close the database connection
        $conn->close();
        ?>

    </div>

    <!-- Popup overlay -->
    <div class="overlay" id="overlay" onclick="closePopup()">
        <!-- Popup to display team information -->
        <div id="popup">
            <h2>Team Information</h2>
            <div id="teamInfo"></div> <!-- Container for team information -->
            <button onclick="closePopup()">Close</button>
        </div>
    </div>

    <!-- Add this script tag to the bottom of your HTML, before the closing </body> tag -->
<script>
    function showTeamPopup(teamId) {
        // Fetch team details from the server using AJAX or any other method
        // For demonstration purposes, I'm using a dummy object
        var teamDetails = {
            name: "Team Name",
            info: "Additional information about the team."
        };

        // Display team information in the popup
        var popupContent = "<h2>" + teamDetails.name + "</h2>";
        popupContent += "<p>" + teamDetails.info + "</p>";

        document.getElementById("teamInfo").innerHTML = popupContent;
        document.getElementById("overlay").style.display = "block";
    }

    function closePopup() {
        document.getElementById("overlay").style.display = "none";
    }
</script>


    <script src="script.js"></script>
</body>

</html>