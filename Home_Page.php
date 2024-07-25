<html>
<?php
    $db_host = '127.0.0.1'; $db_user = 'root'; $db_db = 'Event Manager';
    // MAMP
    $db_password = 'root'; $db_port = '8889';
    $mysqli = new mysqli($db_host, $db_user, $db_password, $db_db, $db_port);
    if ($mysqli->connect_error) {
    echo 'Errno: '.$mysqli->connect_errno;
    echo '<br>';
    echo 'Error: '.$mysqli->connect_error;
    exit();
    }

    $sql = "SELECT * FROM Events;";
    $results = $mysqli->query($sql);
    if (!$results) { die("Query failed: " . $mysqli->error); }

    ?>

    <left>
        <head>
            <title>Home Page</title>
            <link rel="stylesheet" href="Project.css"/>
        </head>
        <body>
            <img class="logo" src="uOttawa Logo.png" 
                    width="80"
                    height="80" />
            <div class="HeaderOfHomepage">
                <H1>University Event Manager </H1>
            </div>
            <br  />
            
            <?php
            
            session_start();

            $User =  $_SESSION["User Name"];

            if ($_SESSION["User Name"]) {
                echo "<p class='ThankYou'>Thank you for registering $User!</p>";
                echo "<p class='dat' id='thanks' ></p>";
            }
        

            ?>
            <script>
                var thanks = document.getElementById("thanks")
                const date = new Date();
                const formattedDate = date.toLocaleString('en-US', { timeZoneName: 'short' });
                thanks.innerText = "Your submission was recorded on: " + formattedDate
                console.log(`Your submission was recorded on: ${formattedDate}`);
            </script>
            
            <table class="tableMain">
                
                <tr>
                    <th class="thMain">Event</th>
                    <th class="thMain">Date of Event</th>
                    <th class="thMain">Time of Event</th>
                    <th class="thMain">RSVP</th>
                </tr>
                <?php

                    foreach ($results as $result) {
                        echo "<tr>";
                        $eventid = $result['EventID'];
                        $event = $result['Event_Name'];
                        $date = $result['Date'];
                        $time = $result['Time'];

                        echo "<td class='tdMain'><a href='Event_Page.php?EventID=$eventid'>$event</a></th>";
                        echo "<td class='tdMain'>$date</th>";
                        echo "<td class='tdMain'>$time</th>";
                        echo "<td class='tdMain'><a href='./RSVP_Form.php?EventID=$eventid'><input type='submit' value='RSVP' /></a></td>";
                        echo "</tr>";
                    }

                ?>
            
            </table>
            <br />
            <img src="campus.png" class="campus"/>
            <p class="CreateAnEventHomePage"><a href="./Event_Submit_Form.php"><b>Create an Event</b></a></p>
        </body>
        
    </left>
</html>
