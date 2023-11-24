<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>World Cup 2030</title>
</head>

<body class="">
    <div class="max-w-screen-xl mx-auto p-4">
        <input type="text" id="searchBar" placeholder="Search for a group" class="p-2 border border-gray-300 rounded-md">
    </div>

    <div id="groupsContainer" class="bg-gray-100 grid grid-cols-2 gap-4 p-7">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "worldcup";

        $conn = new mysqli($servername, $username, $password, $dbname);

        $groupQuery = "SELECT * FROM groups";
        $groupResult = $conn->query($groupQuery);

        while ($groupRow = $groupResult->fetch_assoc()) {
            echo "<div class='flex justify-between bg-v p-4 rounded shadow w-full h-[100%] group-item'>
                <div class='flex flex-col'>
                    <h2 class='text-2xl font-bold mb-2 text-gray-800'>" . $groupRow['group_name'] . "</h2>
                    <p class='text-blue-600'>Stadium: " . $groupRow['stadium_name'] . "</p>
                </div>
                
                <button onclick='showTeams(" . $groupRow['id'] . ")' class='mt-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-900 focus:outline-none'>View Teams</button>
            </div>";
        }

        $conn->close();
        ?>
    </div>

    <div id="teamsPopup" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 hidden">
        <div id="popupContent" class="m-auto w-2/3 bg-white p-8 rounded shadow">
            <h2 id="popupTitle" class="text-2xl font-bold mb-4 text-gray-800"></h2>
            <ul id="teamsList" class="list-disc pl-6"></ul>
            <button onclick="hideTeamsPopup()" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none">Close</button>
        </div>
    </div> 
    </div>

    <script src="script.js"></script>

    <script>
        function filterGroups() {
            var input, filter, groupsContainer, groups, group, i, txtValue;
            input = document.getElementById('searchBar');
            filter = input.value.toUpperCase();
            groupsContainer = document.getElementById('groupsContainer');
            groups = groupsContainer.getElementsByClassName('group-item');

            for (i = 0; i < groups.length; i++) {
                group = groups[i];
                txtValue = group.textContent || group.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    group.style.display = '';
                } else {
                    group.style.display = 'none';
                }
            }
        }

        document.getElementById('searchBar').addEventListener('input', filterGroups);
        
        function hideTeamsPopup() {
            document.getElementById('teamsPopup').style.display = 'none';
        }
    </script>

</body>

</html>