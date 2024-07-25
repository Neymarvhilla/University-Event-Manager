<html>
    <left>
        <head>
            <title>Event Submission Form</title>
            <link rel="stylesheet" href="Project.css"/>
        </head>
        <body>
            <img class="logo" src="uOttawa Logo.png" 
                    width="80"
                    height="80" />
            <div class="HeaderOfHomepage">
                <H1>University Event Manager </H1>
            </div>
            <br />
            <form action="Event_form_handler.php" method="post" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td colspan="3"> <h2 class="centerh2">Event Submission Form</h2></td>
                    </tr>
                    <tr>
                        <th class="thMain">Coordinator Name*:</th>
                        <td class="tdMain"><input type="text" name="firstname" placeholder="First name" required />
                            <input type="text" name="lastname" placeholder="Last name" required /></td>
                    </tr>
                    <tr>
                        <th class="thMain">Coordinator Email*:</th>
                        <td class="tdMain"><input type="text" name="email" placeholder="Email" required /></td>
                    </tr>
                    <tr>
                        <th class="thMain">Coordinator Phone number*:</th>
                        <td class="tdMain"><input type="text" name="phone" Placeholder="123-456-7890" required /></td>
                    </tr>
                    <tr>
                        <th class="thMain">Event Title*:</th>
                        <td class="tdMain"><input type="text" name="title" required /></td>
                    </tr>
                    <tr>
                        <th class="thMain">Event Date*:</th>
                        <td class="tdMain"><input type="text" name="date" required /></td>
                    </tr>
                    <tr>
                        <th class="thMain">Event Time*:</th>
                        <td class="tdMain"><input type="text" name="time" required /></td>
                    </tr>
                    <tr>
                        <th class="thMain">Event Details*:</th>
                        <td class="tdMain"><textarea name="details" cols="40" rows="3" required></textarea></td>
                    </tr>
                    <tr>
                        <th class="thMain">Event Capacity*:</th>
                        <td class="tdMain"><input type="text" name="Capacity" required /></td>
                    </tr>
                    <tr>
                        <th class="thMain">Event Location*:</th>
                        <td class="tdMain"><input type="text" name="location" required /></td>
                    </tr>
                    <tr>
                        <th class="thMain">Event Picture*:</th>
                        <td class="tdMain"><input type="file" name="EventPicture" value="Upload Event Picture" required></td>
                    </tr>
                    <tr>
                        <th class="thMain">Additional Information:</th>
                        <td class="tdMain"><textarea name="Add_Info" cols="40" rows="3"></textarea></td>
                    </tr>
                    <tr>
                        <td class="tdMain" colspan="2"><input type="checkbox" name="order" value="terms" required /><a href="terms-conditions-agreement.pdf">I accept the terms and conditions</a></th>
                    </tr>
                    <tr>
                        <td class="tdMain" colspan="2"><input type="submit" value="Submit" /> <input type="reset" value="Reset" /></th>
                    </tr>
                </table>
            </form>
            <p class="BackToHomePageEvent"><a href="./Home_Page.php">Back to Home Page</a></p>
        </body>
        
    </left>
</html>
