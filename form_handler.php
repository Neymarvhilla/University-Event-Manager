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

    $eventid = $_REQUEST['eventid'];
    $org_id = $_REQUEST['organizerid'];
    $details = $_REQUEST['details'];

    echo "the Event ID is: $eventid";
    echo "<br  />the Organizer ID is: $org_id";
    echo "<br  />the Question is: $details";

    $sql = "SELECT * FROM Questions WHERE EventID='$eventid';";
    $results = $mysqli->query($sql);

    if (!$results) { die("Query failed: " . $mysqli->error); }

    foreach ($results as $result) {
    
        foreach ($result as $key => $value) {

            echo "<br  />The deatils are ($details) and the value is ($value) and the key is: ($key)";

            if($value == $details || $details == "") { // Used to know if this question should be added to the database
                echo "<br  />Im in this if statement";
               $x = $x + 1;

            }
        }
    }

    if($x < 1) {
        echo "<br  />The deatils are ($details) and the value is ($value) and the key is: ($key)";
        echo "<br  />Event will be added";
        $sql = "INSERT INTO `Questions` (`QuestionID`, `Question`, `EventID`, `OrganizerID`) VALUES (NULL, '$details', '$eventid', '$org_id');";
        $results = $mysqli->query($sql);
    }

    $num = $results->num_rows;
    echo "<br  /><br  />There are $num rows";

    header("Location: Event_Page.php?EventID=$eventid");

    $mysqli->close();    

    ?>