// navbar responsive 

function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}


// JavaScript functions to handle popup display
function showTeamPopup(groupId) {
    // Make an AJAX request to fetch teams for the selected group ID
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var teams = JSON.parse(xhr.responseText);
            displayTeamInfo(teams);
            document.getElementById('overlay').style.display = 'flex'; // Display the overlay
        }
    };
    xhr.open("GET", "get_teams.php?groupId=" + groupId, true);
    xhr.send();
}

function displayTeamInfo(teams) {
    var teamInfoContainer = document.getElementById('teamInfo');
    teamInfoContainer.innerHTML = ''; // Clear previous content

    // Display team information in the container
    for (var i = 0; i < teams.length; i++) {
        var team = teams[i];
        //  "<img src='maroc.png' alt='" +  team.Name + "'>"
        var teamInfo = "<p>Team Name: " + team.Name + "</p>"; 
        teamInfoContainer.innerHTML += teamInfo;
    }
}

function closePopup() {
    document.getElementById('overlay').style.display = 'none'; // Hide the overlay
}
