<?php

$email = $_REQUEST['email'];

if (strpos($email, "uottawa.ca") == false) {
    echo "false";
} else {
    echo "true";
}

?>