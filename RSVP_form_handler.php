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

    $fname = $_REQUEST['firstname'];
    $lname = $_REQUEST['lastname'];
    $NAME = "$fname $lname";
    $email = $_REQUEST['email'];
    $phone = $_REQUEST['phone'];
    $faculty = $_REQUEST['faculty'];
    $program = $_REQUEST['program'];
    $YearOfStudy = $_REQUEST['YearOfStudy'];
    $Add_Info = $_REQUEST['Add_Info'];
    $eventid = $_REQUEST['eventid'];

    $sql = "SELECT * FROM Attendees WHERE EventID = $eventid;";
    $results = $mysqli->query($sql);

    $num = $results->num_rows;
    echo "num rows: $num<br />";

    $sql = "SELECT * FROM Events WHERE EventID = $eventid;";
    $results = $mysqli->query($sql);

    foreach ($results as $result) {
        $capacity = $result['Capacity'];
    }

    echo $eventid;
    echo "<br  />";

    session_start();
    $_SESSION["User Name"] = $NAME;

    // $array = ["Value1", "Value2"];
    // echo $array;
    // echo "<br  />";

    // if(!isset($_SESSION["EventIDs"])) {
    //     $array = array("Value1", "Value2");
    //     // $_SESSION["EventIDs"] = $array;
    //     echo $array;
    //     echo "<br  />";
    // }

    // $EventIDs = $_SESSION["EventIDs"];
    // echo $EventIDs;
    // echo "<br  />";
    // $NewEventIDs = array_push($EventIDs, "Here");
    // echo $NewEventIDs;
    // echo "<br  />";
    // $_SESSION["EventIDs"] = $NewEventIDs;

    echo $YearOfStudy;
    echo $eventid;
    

    echo "Attendee added to database";
    $sql = "INSERT INTO `Attendees` (`AttendeeID`, `Name`, `Email`, `Phone_Number`, `Faculty`, `Program`, `Year_of_Study`, `Accommodations`, `EventID`) VALUES (NULL, '$NAME', '$email', '$phone', '$faculty', '$program', '$YearOfStudy', '$Add_Info', '$eventid');";
    echo "<br  /> $sql";
    $results = $mysqli->query($sql);

    header("Location: Home_Page.php?");

    $mysqli->close();    

    ?>