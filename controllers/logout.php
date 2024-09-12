<?php

session_start();

// Destroy the session

session_unset(); // Unset the session means that the session is unset and the data is removed from the server and we cannot access it from any page just by writing session_unset() at the top of that page where we want to unset the session

session_destroy(); // Destroy the session means that the session is destroyed and the data is removed from the server and we cannot access it from any page just by writing session_destroy() at the top of that page where we want to destroy the session

header("Location: /login");