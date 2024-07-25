<html>
    <form action="form_handler.php" method="post">
    
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

    $eventid = $_GET['EventID'];
    $sql = "SELECT * FROM Events WHERE EventID='$eventid';";

    $results = $mysqli->query($sql);
    if (!$results) { die("Query failed: " . $mysqli->error); }

    ?>
    <left>
        <head>
            <title>Event</title>
            <link rel="stylesheet" href="Project.css"/>
        </head>
        <body>
            <img class="logo" src="uOttawa Logo.png" 
                    width="80"
                    height="80" />
            <div class="HeaderOfHomepage">
                <H1>University Event Manager </H1>
            </div>
            <h2 class="centerh2">
            <?php 
                $result = $results->fetch_assoc(); 
                echo $result["Event_Name"]; 
                ?>
            </h2>
            <table class="EventTable">
            <?php

                foreach ($results as $result) {
                    echo "<tr>";
                    $location = $result['Location'];
                    $date = $result['Date'];
                    $time = $result['Time'];
                    $description = $result['Event_Description'];
                    $add_info = $result['Additional_Information'];
                    $organizer_id = $result['OrganizerID'];
                    $image = $result['Image'];
                    
                    echo "<td class='tdEvent'><b>Date: </b>$date</th>";
                    echo "<td class='tdEvent'><b>Time: </b>$time</th>";
                    echo "<td class='tdEvent'><b>Location: </b>$location</th>";
                    echo "</tr>";
                }
                ?>
                <tr>
                    <td colspan="3"><br />
                        <?php echo '<img class="EventImage" src="data:image/jpeg;base64,'.base64_encode($image).'" 
                                    width="1024"
                                    height="576" />'; ?>
                    </td>
                </tr>
                <tr>
                    <td><br /></td>
                </tr>
                <tr>
                    <td class="tdEvent" colspan="3" class="tdleft"><b>Event Description: </b><?php echo $description ?></td>
                </tr>
                <tr>
                    <td class="tdEvent" colspan="3" class="tdleft"><b>Additional Information: </b><?php echo $add_info ?></td>
                </tr>
                <tr>
                    <td colspan="3"><br /></td>
                </tr>
                <tr>
                    <td class="OrganizerDetailsEvent" colspan="3"><b>Event Organizer Information</b></td>
                </tr>
                <?php 

                $sql = "SELECT * FROM Organizers WHERE OrganizerID='$organizer_id';";

                $results = $mysqli->query($sql);

                foreach ($results as $result) {
                    echo "<tr>";
                    $name = $result['Name'];
                    $email = $result['Email'];
                    $phone = $result['Phone_Number'];
                    
                    echo "<td class='tdEvent'><b>Name: </b>$name</th>";
                    echo "<td class='tdEvent'><b>Email: </b>$email</th>";
                    echo "<td class='tdEvent'><b>Phone Number: </b>$phone</th>";
                    echo "</tr>";
                }

                ?>
                <tr>
                    <td class="text" colspan="3"><br /><button><a href=<?php echo "./RSVP_Form.php?EventID=$eventid" ?> >RSVP</a></button></td>
                </tr>
                <tr>
                    <td><br /></td>
                </tr>
                <tr>
                    <td class="OrganizerDetailsEvent" colspan="3"><b>Previously Asked Questions</b></td>
                </tr>
                <?php 

                $sql = "SELECT * FROM Questions WHERE EventID='$eventid';";

                $results = $mysqli->query($sql);

                echo "<ul>";
                foreach ($results as $result) {
                    echo "<tr>";
                    $question = $result['Question'];
                    
                    echo "<td class='tdEvent' colspan='3'><li>$question</li></td>";
                    echo "</tr>";
                }
                echo "</ul>";
                ?>
                <tr>
                    <td><br /></td>
                </tr>
                <tr>
                    <td class="OrganizerDetailsEvent" colspan="3"><b>Any Questions?</b></td>
                </tr>
                
                <tr>
                    <td colspan="3" class="EventComments"><textarea name="details" cols="100" rows="3" placeholder="Questions / Comments"></textarea></td>
                </tr>
                <input type="hidden" name="eventid" value='<?php echo "$eventid";?>'/>
                <input type="hidden" name="organizerid" value='<?php echo "$organizer_id";?>'/>
            
                <tr>
                    <td class="" colspan="3"><input type="submit" value="Submit Question/Comment" /></td>
                </tr>
            </table>
            <p class="BackToHomePageEvent"><a href="./Home_Page.php">Back to Home Page</a></p>
        </body>
    </left>
    </form>
</html>
