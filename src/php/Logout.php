<?php
	session_start();

    #destroys all sessions created during this users visit when they loog out
    if(session_destroy()) {
        #returns the user to the home screen
		header("Location: ../home.php");
		}
?>