<?php 

    /*
        This file houses all validation for forms
    */



    // Function: validate_text()
    // Validates raw text fields against rules, sanitizes by removing any HTML tags and encoding special characters.
    function validate_text($key, $required = true, $trim = true, $sanitize = true) {

        // If required and empty ...
        if ($required && empty($_POST[$key])) {
            // ... return error
            return 'required';

        // If not required and empty ...
        } else if (!$required && empty($_POST[$key])) {
            // Just return ok
            return 'ok';
        }

        // Put into temp variable
        $value = $_POST[$key];

        // Trim excess white space
        if ($trim) $value = trim($value);

        // If we need to sanitize ...
        if ($sanitize) {

            // ... remov any HTML tags and encoding the remaining special characters
            $value = htmlspecialchars(strip_tags($value));

            // If value came back empty, there was either an error or something malicious
            if (empty($value)) {
                // null the data so we don't accidentally output it
                $_POST[$key] = null;

                // return error
                return 'sanitize';
            }
        }

        // Set POST data to sanitized value
        $_POST[$key] = $value;

        // Return good
        return 'ok';
    }



    // Function: validate_enum()
    // Validates text fields against values passed.
    function validate_enum($key, $values = [], $required = true ) {

        // If required and empty ...
        if ($required && empty($_POST[$key])) {
            // ... return error
            return 'required';

        // If not required and empty ...
        } else if (!$required && empty($_POST[$key])) {
            // Just return ok
            return 'ok';
        }

        // If the submitted value is not in the expected values ...
        if (!in_array($_POST[$key], $values)) {
            // ... then null the data as it could be malicious 
            // (this should be used to check select, checkbox and radio options. Expected values should be predetermined so anything outside of that can be considered malicious)
            $_POST[$key] = null;

            // return error
            return 'value';
        }

        // Return good
        return 'ok';
    }



    // Function: validate_email()
    // Validates for a valid email
    function validate_email($key, $required = true) {
        
        // If required and empty ...
        if ($required && empty($_POST[$key])) {
            // ... return error
            return 'required';

        // If not required and empty ...
        } else if (!$required && empty($_POST[$key])) {
            // Just return ok
            return 'ok';
        }

        // Put into temp variable
        $value = $_POST[$key];

        // Using PHP's native email validator
        if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
            // if it wasn't a valid email, encode any entities and return it so the user can correct it.
            $_POST[$key] = htmlentities($_POST[$key]);

            // return error
            return 'sanitize';
        }

        // return good
        return 'ok';
    }



    // Function: validate_pass()
    // Validates password against minimum security requirements
    function validate_pass($pass_key, $pass_conf_key, $required = true) {
    
        // If required and empty ...
        if ($required && (empty($_POST[$pass_key]) || empty($_POST[$pass_conf_key]))) {
            // ... return error
            return 'required';

        // If not required and empty ...
        } else if (!$required && empty($_POST[$pass_key]) && empty($_POST[$pass_conf_key])) {
            // Just return ok
            return 'ok';
        }

        // Make sure password and the confirmation password match
        if ($_POST[$pass_key] != $_POST[$pass_conf_key]) {
            // return error if they don't
            return 'match';
        }

        // Make sure the password meets security criteria
        // (?=.*[a-z]) = positive lookahead for 1 lowercase character
        // (?=.*[A-Z]) = positive lookahead for 1 uppercase character
        // (?=.*[0-9]) = positive lookahead for 1 number
        // (?=.{8,})   = positive lookahead for at least 8 characters long
        if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})/" , $_POST[$pass_key])){
            // if it doesn't meet criteria, return error
            return 'pattern';
        }

        // return good
        return 'ok';
    }



    // Function: validate_int()
    // Validates for a integer 
    function validate_int($key, $required = true, $sanitize = true) {
        
        // If required and empty ...
        if ($required && empty($_POST[$key])) {
            // ... return error
            return 'required';

        // If not required and empty ...
        } else if (!$required && empty($_POST[$key])) {
            // Just return ok
            return 'ok';
        }

        // Put into temp variable
        $value = $_POST[$key];

        // If we need to sanitize ...
        if ($sanitize) {

            // Parse it for only an int value
            $value = intval($value);

            // If we were expecting an int and didn't get one, we can consider this malicious
            if (empty($value)) {
                // Null the value so we don't output it
                $_POST[$key] = null;

                // return error
                return 'sanitize';
            }
        }

        // Set POST to sanitized value
        $_POST[$key] = $value;

        // return good
        return 'ok';
    }



    // Function: validate_phone()
    // Validates for a phone number and normalizes the format 
    function validate_phone($key, $required = true) {

        // If required and empty ...
        if ($required && empty($_POST[$key])) {
            // ... return error
            return 'required';

        // If not required and empty ...
        } else if (!$required && empty($_POST[$key])) {
            // Just return ok
            return 'ok';
        }

        // Put into temp variable
        $value = $_POST[$key];

        // Matches for a Canadian or US phone number in many different formats and captures the 3 main groups of numbers
        // /^\s* = remove any whitespace at the start
        // (?:1|\+1)? = non-capturing the 1 or +1 if they entered it
        // [ \-.]* = optional acceptable spacers
        // \(? = optional opening bracket of area code
        // ([0-9]{3}) = capture the area code (first part of phone number)
        // \)? = optional closing bracket of area code
        // [ \-.]* = optional acceptable spacers
        // ([0-9]{3}) = capture the second part of the phone number
        // [ \-.]* = optional acceptable spacers
        // ([0-9]{3}) = capture the last part of the phone number
        // \s*$ = remove any whitespace at the end
        if(!preg_match("/^\s*(?:1|\+1)?[ \-.]*\(?([0-9]{3})\)?[ \-.]*([0-9]{3})[ \-.]*([0-9]{4})\s*$/" , $_POST[$key], $matches)){
            // If it didn't match the pattern, return error
            return 'pattern';
        }

        // Normalizing the phone number into the following format
        // +1 (416) 123-4567
        $_POST[$key] = '+1 ('.$matches[1].') '.$matches[2].'-'.$matches[3];

        // return good
        return 'ok';
    }



    // Function: validate_coords()
    // Validates for coordinates
    function validate_coords($key_lat, $key_long, $required = true, $sanitize = true) {

        // If required and empty ...
        if ($required && (empty($_POST[$key_lat]) || empty($_POST[$key_long]))) {
            // ... return error
            return 'required';

        // If not required and empty ...
        } else if (!$required && empty($_POST[$key_lat]) && empty($_POST[$key_long])) {
            // Just return ok
            return 'ok';
        }

        // Put into temp variables
        $value_lat = $_POST[$key_lat];
        $value_long = $_POST[$key_long];

        // If we need to sanitize ...
        if ($sanitize) {

            // Parse it for only an float value
            $value_lat = floatval($value_lat);
            $value_long = floatval($value_long);

            // If we were expecting an float and didn't get one, we can consider this malicious
            if (empty($value_lat) || empty($value_long)) {
                // Null the value so we don't output it
                $_POST[$key_lat] = null;
                $_POST[$key_long] = null;

                // return error
                return 'sanitize';
            }
        }

        // Check that the coords are in range
        if (-90 > $value_lat || $value_lat > 90 || -180 > $value_long || $value_long > 180) {
            // If not, return error
            return 'invalid';
        }

        // Set POST to sanitized value
        $_POST[$key_lat] = $value_lat;
        $_POST[$key_long] = $value_long;

        // return good
        return 'ok';
    }



    // Function: validate_coords()
    // Validates for coordinates
    function validate_image($key, $accepted_type = array('jpg','jpeg','png'), $accepted_size = '20971520‬', $required = true) {

        // If required and empty ...
        if ($required && (empty($_FILES[$key]) || $_FILES[$key]['error'] == 4)) {
            // ... return error
            return 'required';
            
        // If not required and empty ...
        } else if (!$required && (empty($_FILES[$key]) || $_FILES[$key]['error'] == 4)) {
            // Just return ok
            return 'ok';
        }

        // Get the file extension
        $extension = strtolower(pathinfo(basename($_FILES[$key]["name"]),PATHINFO_EXTENSION));

        // Check that the file is an acceptable type
        if (!in_array($extension, $accepted_type)) {
            return 'type';
        }

        // Check the file extension against the mime type to ensure validity
        if (
            ($extension == 'png' && $_FILES[$key]["type"] != 'image/png')
            ||
            ($extension == 'jpg' && $_FILES[$key]["type"] != 'image/jpeg')
            ||
            ($extension == 'jepg' && $_FILES[$key]["type"] != 'image/jpeg')
        ) {
            $_FILES[$key] = null;
            return 'type';
        }

        // Check to make sure the file is under the max size
        if ($_FILES[$key]["size"] > intval($accepted_size)) return 'size';

        // Return good
        return 'ok';
    }

    
