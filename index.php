<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>World Cup 2030</title>
</head>

<body class=" ">



    <nav class="bg-violet border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="index.php" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="img/icons8-coupe-du-monde-48.png" class="h-8" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">world Cup</span>
            </a>
            <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false" onclick="toggleNavbar()">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="#" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Teams</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Plyers</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <section style="background-color: #4a094ae3;">
        <div class=" flex justify-around gap-2 container mx-auto py-6 sm:py-8 lg:px-6 xl:px-8">
            <p class="text-center my-24 text-white">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                 Explicabo excepturi cupiditate sequi quasi rerum officiis 
                 maxime, sint eum, natus quas, deserunt iure? Numquam beatae
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
               
            </p>

            <img class="w-full h-96" src="img/dribbble_morocco_2030_fifa-01_4x.jpg" alt="">

        </div>
    </section>

    <!-- Main Groups Section -->
    <div class="bg-gray-100 grid grid-cols-2 gap-4 p-7 ">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "worldcup";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve group data
        $groupQuery = "SELECT * FROM groups";
        $groupResult = $conn->query($groupQuery);

        while ($groupRow = $groupResult->fetch_assoc()) {
            echo "<div class='flex justify-between bg-v p-4 rounded shadow w-full h-[100%]'>
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


    <!-- Teams Popup -->
    <div id="teamsPopup" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 hidden">
        <div id="popupContent" class="m-auto w-2/3 bg-white p-8 rounded shadow">
            <h2 id="popupTitle" class="text-2xl font-bold mb-4 text-gray-800"></h2>
            <ul id="teamsList" class="list-disc pl-6"></ul>
            <button onclick="hideTeamsPopup()" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none">Close</button>
        </div>
    </div>

    <script src="script.js"></script>



</body>

</html>