<?php

// This class will validate user input e.g. username, email, password, etc.
class Validator {

    // If the string is between the min and max length, return true
    public static function string($value, $min = 1, $max = INF) {
        $value = trim($value); // trim removes whitespace from the beginning and end of a string

        return strlen($value) >= $min && strlen($value) <= $max; 
    }

    // If the value is a valid email, return true
    public static function email($value) {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    // If password is min 8 characters, return true
    public static function password($value, $min = 8, $max = INF) {
        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function passwordCheck($value) {
        for ($i = 0; $i < strlen($value); $i++) {
            // if the password does not contain any special characters, return false
            if (!preg_match('/[^a-zA-Z0-9_]/', $i)) {
                return false;
            }
        }
    }
}