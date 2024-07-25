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

    $sql = "SELECT * FROM Organizers WHERE name LIKE '$NAME';";
    $results = $mysqli->query($sql);
    $num = $results->num_rows;

    foreach($results as $result) {
        $name = $result['Name'];

        if ($name == $NAME) {
            $x = $x + 1;
            $org_id = $result['OrganizerID'];
            echo "THIS PERSON ALREADY EXISTS";
        } 
    }

    if ($x == 0) {
        echo "Organizer will be added to database";
        $sql = "INSERT INTO `Organizers` (`OrganizerID`, `Name`, `Email`, `Phone_Number`) VALUES (NULL, '$NAME', '$email', '$phone');";
        echo "<br  /> $sql";
        $results = $mysqli->query($sql);
    }

    # Get Image details
    $image = $_FILES['EventPicture']['tmp_name'];
    $imgContent = addslashes(file_get_contents($image));

    $sql = "SELECT * FROM Organizers WHERE name LIKE '$NAME';";
    $results = $mysqli->query($sql);

    foreach($results as $result) {
        $name = $result['Name'];
        $org_id = $result['OrganizerID'];
    }

    $title = $_REQUEST['title'];
    $date = $_REQUEST['date'];
    $time = $_REQUEST['time'];
    $details = $_REQUEST['details'];
    $capacity = $_REQUEST['Capacity'];
    $location = $_REQUEST['location'];
    $picture = $_REQUEST['EventPicture'];
    $add_info = $_REQUEST['Add_Info'];

    echo "<br  />Event will be added";
    $sql = "INSERT INTO `Events` (`EventID`, `Event_Name`, `Date`, `Time`, `Location`, `Event_Description`, `Additional_Information`, `Capacity`, `OrganizerID`, `Image`) VALUES (NULL, '$title', '$date', '$time', '$location', '$details', '$add_info', '$capacity', '$org_id', '$imgContent');";
    $results = $mysqli->query($sql);

    session_start();
    $_SESSION["User Name"] = $NAME;

    header("Location: Home_Page.php?");

    $mysqli->close();    

    ?>