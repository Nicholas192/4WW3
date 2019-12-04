<?php

    /*
        This file houses all database calls with some minor logic
    */



    // Connecting to the data everytime. We'll alway need something
    // Try/catch inclase something fails.
    try {
        // Create PDO connection to MySQL
        $pdo = new PDO(DB_DSN, DB_USR, DB_PSW);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {

        // We need the database. 
        // If the connection failed, show error message stop processing
        echo "Database connection failed";
        exit();
    }



    // Function create_login()
    // Creates a user login
    function create_login($name,$email,$password,$pic_path,$marketing) {

        // Get the PDO DB connection
        global $pdo;

        // Simple password encryption
        $password = sha1($email.'upupdowndownleftrightleftright'.$password.'ABABSelectStart');

        // Try incase the DB is gone
        try {

            // Prepare our insert statement
            $stmt = $pdo->prepare("INSERT INTO users (name,email,password,pic_path,marketing) VALUES (?, ?, ?, ?, ?)");

            // Execute the query with these parameters
            $stmt->execute([$name,$email,$password,$pic_path,$marketing]);

        } catch (PDOException $e) {

            // If it was a duplicate entry, return the error.
            if (strpos($e->getMessage(), 'Duplicate entry')) {
                return 'duplicate entry';
            }

        // If it succeeded, return the user_id so we can log them in
        return $pdo->lastInsertId();
    }



    // Function check_login()
    // Checks if a users login credentials are correct
    function check_login($email,$password) {

        // Get the PDO DB connection
        global $pdo;

        // Build the password
        $password = sha1($email.'upupdowndownleftrightleftright'.$password.'ABABSelectStart');

        // Try incase the DB is gone
        try {

            // Prepare our SQL statement
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email=? AND password=? ");

            // Execute the query with these parameters
            $stmt->execute([$email,$password]);

            // Pull the results as an associated array
            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            // Do nothing if it fails since we deal with this later
        }

        // If there are no entries, return false
        if(!$arr) return false;

        // If there was an entry, return the user_id
        return $arr[0]['id'];
    }




    // Function get_user()
    // Get's the user based on the user_id
    function get_user($id) {

        // Get the PDO DB connection
        global $pdo;

        // Try incase the DB is gone
        try {

            // Prepare our SQL statement
            $stmt = $pdo->prepare("SELECT * FROM users WHERE id=?");

            // Execute the query with these parameters
            $stmt->execute([$id]);

            // Pull the results as an associated array
            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            // Do nothing if it fails since we deal with this later
        }

        // If there are no entries, return false
        if(!$arr) return false;

        // If there was an entry, return the user's record
        return $arr[0];
    }




    // Function create_restaurant()
    // Creates a restaurant
    function create_restaurant($name,$address,$phone,$lat,$long,$pic_path,$description) {

        // Get the PDO DB connection
        global $pdo;

        // Try incase the DB is gone
        try {

            // Prepare our Insert statement
            $stmt = $pdo->prepare("INSERT INTO restaurants (`name`,`address`,`phone`,`lat`,`long`,`pic_path`,`description`) VALUES (?,?,?,?,?,?,?)");

            // Execute the query with these parameters
            $stmt->execute([$name,$address,$phone,$lat,$long,$pic_path,$description]);

        } catch (PDOException $e) {
            // This shouldn't fail. But there's nothing dependant on this so just return false;
            return false;
        }

        // If it succeeded, return the restaurant ID so we can redirect to it
        return $pdo->lastInsertId();
    }




    // Function search_restaurant()
    // Search for a restaurant by a restaurant's ID
    // If no ID is supplied, it will returh all in decending order of creation
    function search_restaurant($id = null) {

        // Get the PDO DB connection
        global $pdo;

        // Try incase the DB is gone
        try {

            // Prepare our SQL statement
            $stmt = $pdo->prepare("SELECT * FROM restaurants ".($id?'WHERE id=?':'')." ORDER BY id DESC");

            // If $id was emtpy, just execute ...
            if (empty($id)) 
                $stmt->execute();

            // ... otherwise pass the $id
            else
                $stmt->execute([$id]);

            // Pull the results as an associated array
            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            // Do nothing if it fails since we deal with this later
        }

        // If there are no entries, return false
        if(!$arr) return false;

        // If $id wasn't set, return the whole result as is;
        // If $id was set, return the result + the reviews
        return (empty($id)?$arr:array_merge($arr[0], ['reviews' => get_ratings($id)]));
    }




    // Function advanced_search_restaurant()
    // Search for a restaurant based on a users search criteria
    // This is a loose search and will match with any part of the users criteria
    function advanced_search_restaurant($search_params = []) {

        // If there were no parameters sent, just return no results
        if (empty($search_params)) return [];

        // If a users position was submitted, set a flag so we can add location stuff to the query
        $calc_distance = (in_array('lat', array_keys($search_params)) && in_array('long', array_keys($search_params)));

        // Start building our SQL statement
        $sql = 'SELECT * ';

        // Add distance calculations for restaurants.
        // Formula adapted from https://stackoverflow.com/a/24372831
        if ($calc_distance) $sql .= ', 111.111 * DEGREES(ACOS(LEAST(1.0, COS(RADIANS('.$search_params['lat'].')) * COS(RADIANS(lat)) * COS(RADIANS('.$search_params['long'].' - `long`)) + SIN(RADIANS('.$search_params['lat'].')) * SIN(RADIANS(lat))))) AS distance ';

        // Build more query
        // Includes hack to only need to add AND between criteria
        $sql .= 'FROM restaurants WHERE 1 = 1 ';

        // Build Were stuff for other criteria
        foreach ($search_params as $key => $value) {

            // If coords paramters, we don't need them. Skip 'em
            if (in_array($key, ['lat','long'])) continue;

            // Join with other criteria and hack to only have to add OR statements to loose match
            $sql .= 'AND (1 = 0 ';

            // Get rid of excess whitespace
            $value = explode(' ', trim($value));

            // Add all words indiviually in LIKE statement so it'll match on anything that matches any word of the string
            foreach ($value as $text) {
                $sql .= 'OR `'.$key.'` LIKE "%'.$text.'%" ';
            }

            $sql .= ') ';
        }

        // Add max range for distance calculations
        // Max 15km
        if ($calc_distance) $sql .= 'HAVING distance < 15';

        // Order the results based on ratings
        $sql .= ' ORDER BY rating DESC;';



        // Get the PDO DB connection
        global $pdo;

        // Try incase the DB is gone
        try {

            // Prepare our SQL statement
            $stmt = $pdo->prepare($sql);

            // Just execute as we've built everything in to the query
            $stmt->execute();

            // Pull the results as an associated array
            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            // Do nothing if it fails since we deal with this later
        }

        // If there are no entries, return no results
        if(!$arr) return [];

        // If there were results, return them.
        return $arr;
    }




    // Function save_rating()
    // Saves a user reveiw
    function save_rating($restaurant_id,$rating,$review) {

        // Get the PDO DB connection
        global $pdo;

        // Try incase the DB is gone
        try {

            // Prepare our Insert statement
            $stmt = $pdo->prepare("INSERT INTO `4ww3`.`reviews` (`restaurant_id`,`rating`,`review`,`user_id`) VALUES (?, ?, ?, ?)");

            // Execute the query with these parameters
            $stmt->execute([$restaurant_id, $rating, $review, auth_get_user_id()]);

        } catch (PDOException $e) {
            // This shouldn't fail. But there's nothing dependant on this so just return false;
            return false;
        }

        // If it succeeded, return the review ID so we know it succeeded
        return $pdo->lastInsertId();
    }




    // Function get_ratings()
    // Get's users reviews for the restaurant id
    function get_ratings($restaurant_id) {

        // Get the PDO DB connection
        global $pdo;

        // Try incase the DB is gone
        try {

            // Prepare our SQL statement
            $stmt = $pdo->prepare("SELECT r.*,u.name,u.pic_path FROM reviews r JOIN users u ON r.user_id = u.id  WHERE restaurant_id = ? ORDER BY date_submitted DESC");

            // Execute the query with these parameters
            $stmt->execute([$restaurant_id]);

            // Pull the results as an associated array
            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            // Do nothing if it fails since we deal with this later
        }

        // If there are no entries, return no results
        if(!$arr) return [];

        // If there were results, return them.
        return $arr;
    }




    // Function update_restaurant_rating()
    // Updates the overall restaurants rating
    function update_restaurant_rating($restaurant_id) {

        // Get the PDO DB connection
        global $pdo;

        // Try incase the DB is gone
        try {

            // Get the calcuated average rating
            $stmt = $pdo->prepare("SELECT SUM(rating)/count(*) as rating FROM reviews WHERE restaurant_id = ?");

            // Execute the query with these parameters
            $stmt->execute([$restaurant_id]);

            // Pull the results as an associated array
            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // If there is a restaurant
            if (!empty($arr[0]['rating'])) {

                // Prepare the Update statemnt
                $stmt = $pdo->prepare("UPDATE `restaurants` SET `rating` = ? WHERE `id` = ?");

                // Execute the query with these parameters
                // Make sure we round the average result so we so whole stars
                $stmt->execute([round($arr[0]['rating']), $restaurant_id]);
            }
        } catch (PDOException $e) {
            // Do nothing if it fails
            // Next time a review submits for the restaurant it'll recalculate
        }
    }

