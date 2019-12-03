<?php 

    function validate_text($key, $required = true, $trim = true, $sanitize = true) {

        if ($required && empty($_POST[$key])) {
            return 'required';
        } else if (!$required && empty($_POST[$key])) {
            return 'ok';
        }

        $value = $_POST[$key];

        if ($trim) $value = trim($value);

        if ($sanitize) {
            $value = htmlspecialchars(strip_tags($value));

            if (empty($value)) {
                $_POST[$key] = null;
                return 'sanitize';
            }
        }

        $_POST[$key] = $value;

        return 'ok';
    }

    function validate_enum($key, $values = [], $required = true ) {

        if ($required && empty($_POST[$key])) {
            return 'required';
        } else if (!$required && empty($_POST[$key])) {
            return 'ok';
        }

        if (!in_array($_POST[$key], $values)) {
            $_POST[$key] = null;
            return 'value';
        }

        return 'ok';
    }

    function validate_email($key, $required = true) {
        
        if ($required && empty($_POST[$key])) {
            return 'required';
        } else if (!$required && empty($_POST[$key])) {
            return 'ok';
        }

        $value = $_POST[$key];

        if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
            $_POST[$key] = htmlentities($_POST[$key]);
            return 'sanitize';
        }

        $_POST[$key] = $value;

        return 'ok';
    }

    function validate_pass($pass_key, $pass_conf_key, $required = true) {
    
        if ($required && (empty($_POST[$pass_key]) || empty($_POST[$pass_conf_key]))) {
            return 'required';
        } else if (!$required && empty($_POST[$pass_key]) && empty($_POST[$pass_conf_key])) {
            return 'ok';
        }

        if ($_POST[$pass_key] != $_POST[$pass_conf_key]) {
            return 'match';
        }

        if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/" , $_POST[$pass_key])){
            return 'pattern';
        }

        return 'ok';
    }

    function validate_int($key, $required = true, $sanitize = true) {

        if ($required && empty($_POST[$key])) {
            return 'required';
        } else if (!$required && empty($_POST[$key])) {
            return 'ok';
        }

        $value = $_POST[$key];

        if ($sanitize) {
            $value = intval($value);

            if (empty($value)) {
                $_POST[$key] = null;
                return 'sanitize';
            }
        }

        $_POST[$key] = $value;

        return 'ok';
    }

    function validate_phone($key, $required = true) {

        if ($required && empty($_POST[$key])) {
            return 'required';
        } else if (!$required && empty($_POST[$key])) {
            return 'ok';
        }

        $value = $_POST[$key];

        if(!preg_match("/^\s*(?:1|\+1)?[ \-.]*\(?([0-9]{3})\)?[ \-.]*([0-9]{3})[ \-.]*([0-9]{4})\s*$/" , $_POST[$key], $matches)){
            return 'pattern';
        }

        // Normalizing the phone number
        $_POST[$key] = '+1 ('.$matches[1].') '.$matches[2].'-'.$matches[3];

        return 'ok';
    }

    function validate_coords($key_lat, $key_long, $required = true, $sanitize = true) {

        if ($required && (empty($_POST[$key_lat]) || empty($_POST[$key_long]))) {
            return 'required';
        } else if (!$required && empty($_POST[$key_lat]) && empty($_POST[$key_long])) {
            return 'ok';
        }

        $value_lat = $_POST[$key_lat];
        $value_long = $_POST[$key_long];

        if ($sanitize) {
            $value_lat = floatval($value_lat);
            $value_long = floatval($value_long);

            if (empty($value_lat) || empty($value_long)) {
                $_POST[$key_lat] = null;
                $_POST[$key_long] = null;
                return 'sanitize';
            }
        }

        if (-90 > $value_lat || $value_lat > 90 || -180 > $value_long || $value_long > 180) {
            return 'invalid';
        }

        $_POST[$key_lat] = $value_lat;
        $_POST[$key_long] = $value_long;

        return 'ok';
    }

    function validate_image($key, $accepted_type = array('jpg','jpeg','png'), $accepted_size = '20971520‬' , $required = true) {

        if ($required && (empty($_FILES["pic_path"]) || $_FILES["pic_path"]['error'] == 4)) {
            return 'required';
        } else if (!$required && (empty($_FILES["pic_path"]) || $_FILES["pic_path"]['error'] == 4)) {
            return 'ok';
        }

        $extension = strtolower(pathinfo(basename($_FILES["pic_path"]["name"]),PATHINFO_EXTENSION));

        if (in_array($extension, $accepted_type)) {
            if (
                ($extension == 'png' && $_FILES["pic_path"]["type"] != 'image/png')
                ||
                (($extension == 'jpg' || $extension == 'jpeg') && $_FILES["pic_path"]["type"] != 'image/jpeg')
            ) {
                $_FILES["pic_path"] = null;
                return 'type';
            }
        } else {
            return 'type';
        }

        if ($_FILES["pic_path"]["size"] > intval($accepted_size)) return 'size';

        return 'ok';
    }

    
