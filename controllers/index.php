<?php

session_start(); // Start the session means that the session is started and the data is stored in the server and we can access it from any page just by writing session_start() at the top of that page where we want to access the data

$heading = "Home";

require "views/index.view.php";