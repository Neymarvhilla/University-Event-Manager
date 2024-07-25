<html>
    <left>
        <head>
            <title>RSVP Page</title>
            <link rel="stylesheet" href="Project.css"/>
        </head>
        <body>
            <img class="logo" src="uOttawa Logo.png" 
                    width="80"
                    height="80" />
            <div class="HeaderOfHomepage">
                <H1>University Event Manager </H1>
            </div>
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

                $sql = "SELECT * FROM Attendees WHERE EventID = $eventid;";
                $results = $mysqli->query($sql);

                $num = $results->num_rows;
                echo "<script>var num = '$num';</script>";

                $sql = "SELECT * FROM Events WHERE EventID = $eventid;";
                $results = $mysqli->query($sql);

                foreach ($results as $result) {
                    $capacity = $result['Capacity'];
                }
                echo "<script>var capacity = '$capacity';</script>";

                $sql = "SELECT * FROM Events WHERE EventID = $eventid;";
                $results = $mysqli->query($sql);

                foreach ($results as $result) {
                    $eventid = $result['EventID'];
                    $event = $result['Event_Name'];
                    $date = $result['Date'];
                    $location = $result['Location'];
                }

            ?>
            <script>

                async function checkCapacity() {
                    console.log("checking capacity");

                    var text

                    if (num < capacity){
                        console.log("Capacity has NOT been reached!")
                        var submit = document.getElementById("submit")
                        submit.disabled = false
                    } else {
                        console.log("Capacity has been reached!")
                        text = "Capacity has been reached!"
                        var submit = document.getElementById("submit")
                        submit.setAttribute("disabled", true)
                        document.getElementById("Capacity").innerText = "" + text
                    } 
                }

                async function checkEmail() {
                    console.log("checking email");

                    var email = document.getElementById("email").value
                    console.log(email)

                    var response = await fetch(`email_handler.php?email=${email}`)
                
                    var text = await response.text()
                    console.log(text)

                    if (text == "false"){
                        console.log("YOU ARE NOT A STUDENT")
                        text =  "You are not allowed to attend this event!"
                        var submit = document.getElementById("submit")
                        submit.setAttribute("disabled", true)
                    } else if (text == "true") {
                        console.log("YOU ARE A STUDENT")
                        text = "Student Verified!"
                        var submit = document.getElementById("submit")
                        submit.disabled = false
                    }

                    document.getElementById("Note").innerText = " " + text
                }
            </script>

            <br  />
            <div class="ThankYou" id="Capacity"></div>

            <form onsubmit="clicked()" action="RSVP_form_handler.php" method="post">
                <table class="form">
                    <tr>
                        <td><br /></td>
                    </tr>
                    <tr>
                        <td colspan="3"> <h2 class="centerh2">RSVP to <b><?php echo $event; ?></b></h2></td>
                    </tr>
                    <tr>
                        <th class="tdMain">Event Date:</th>
                        <td class="tdMain"><?php echo $date; ?></td>
                    </tr>
                    <tr>
                        <th class="tdMain">Event Location:</th>
                        <td class="tdMain"><?php echo $location; ?></td>
                    </tr>
                    <tr>
                        <td><br /></td>
                    </tr>
                    <tr>
                        <td class="RSVPStudentInfo" colspan="3"><b>Student Information</b></td>
                    </tr>
                    <tr>
                        <th class="tdMain">Student Name*:</th>
                        <td class="tdMain"><input type="text" name="firstname" placeholder="First name" onblur="checkCapacity()" required />
                            <input type="text" name="lastname" placeholder="Last name" required /></td>
                    </tr>
                    <tr>
                        <th class="tdMain">Student Email*:</th>
                        <td class="tdMain"><input type="text" name="email" id="email" placeholder="@uottawa.ca" onblur="checkEmail()" required/><span id="Note"></span></td>
                    </tr>
                    <tr>
                        <th class="tdMain">Student Phone number*:</th>
                        <td class="tdMain"><input type="text" name="phone" placeholder="123-456-7890" required /></td>
                    </tr>
                    <tr>
                        <th class="tdMain">Student Faculty:</th>
                        <td class="tdMain"><input type="text" name="faculty" /></td>
                    </tr>
                    <tr>
                        <th class="tdMain">Student Program:</th>
                        <td class="tdMain"><input type="text" name="program" /></td>
                    </tr>
                    <tr>
                        <th class="tdMain">Student Year of Study:</th>
                        <td class="tdMain"><select name="YearOfStudy">
                            <option value="0"></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select></td>
                    </tr>
                    <tr>
                        <th class="tdMain">Student Accommodations:</th>
                        <td class="tdMain"><textarea name="Add_Info" cols="40" rows="3"></textarea></td>
                    </tr>
                    <tr>
                        <td class="tdMain" colspan="2"><input type="checkbox" name="order" value="terms" required/><a href="terms-conditions-agreement.pdf">I accept the terms and conditions</a></th>
                    </tr>

                    <input type="hidden" name="eventid" value='<?php echo "$eventid";?>'/>

                    <tr>
                        <td class="tdMain" colspan="2"><input type="submit" value="Submit" id="submit" /> <input type="reset" value="Reset" /></th>
                    </tr>
                </table>
            </form>
            <p class="BackToHomePageEvent"><a href="./Home_Page.php">Back to Home Page</a></p>
            
            <script>

            function clicked() {
                var submit = document.getElementById("submit")
                submit.setAttribute("disabled", true);
            }

	        </script>

        </body>
    </left>
</html>
