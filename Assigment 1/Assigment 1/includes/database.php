<?php

    try {
      $pdo = new PDO(DB_DSN, DB_USR, DB_PSW);
      $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo "Connection Failed: ".$e->getMessage();
      exit();
    }

    function create_login($name,$email,$password,$pic_path,$marketing) {
      global $pdo;
      $password = sha1($password.'upupdowndownleftrightleftright'.$password.'ABABSelectStart');
      $stmt = $pdo->prepare("INSERT INTO users (name,email,password,pic_path,marketing) VALUES (?, ?, ?, ?, ?)");
      $stmt->execute([$name,$email,$password,$pic_path,$marketing]);
      return $pdo->lastInsertId();
    }

    function check_login($email,$password) {
      global $pdo;
      $password = sha1($password.'upupdowndownleftrightleftright'.$password.'ABABSelectStart');
      $stmt = $pdo->prepare("SELECT * FROM users WHERE email=? AND password=? ");
      $stmt->execute([$email,$password]);
      $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
      if(!$arr) return false;
      return $arr[0]['id'];
    }

    function create_restaurant($name,$address,$phone,$lat,$long,$pic_path,$description) {
      global $pdo;
      $stmt = $pdo->prepare("INSERT INTO restaurants (`name`,`address`,`phone`,`lat`,`long`,`pic_path`,`description`) VALUES (?,?,?,?,?,?,?)");
      $stmt->execute([$name,$address,$phone,$lat,$long,$pic_path,$description]);
      return $pdo->lastInsertId();
    }

    function search_restaurant($id = null) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM restaurants ".($id?'WHERE id=?':'')." ORDER BY id DESC");
        if (empty($id)) 
            $stmt->execute();
        else
            $stmt->execute([$id]);
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(!$arr) return false;
        return (empty($id)?$arr:array_merge($arr[0], ['reviews' => get_ratings($id)]));
    }

    function advanced_search_restaurant($search_params = []) {

        if (empty($search_params)) return [];

        $calc_distance = (in_array('lat', array_keys($search_params)) && in_array('long', array_keys($search_params)));

        $sql = 'SELECT * ';

        // Formula adapted from https://stackoverflow.com/a/24372831
        if ($calc_distance) $sql .= ', 111.111 * DEGREES(ACOS(LEAST(1.0, COS(RADIANS('.$search_params['lat'].')) * COS(RADIANS(lat)) * COS(RADIANS('.$search_params['long'].' - `long`)) + SIN(RADIANS('.$search_params['lat'].')) * SIN(RADIANS(lat))))) AS distance ';

        $sql .= 'FROM restaurants WHERE 1 = 1 ';

        foreach ($search_params as $key => $value) {

            if (in_array($key, ['lat','long'])) continue;

            $sql .= 'AND (1 = 0 ';

            $value = explode(' ', trim($value));

            foreach ($value as $text) {
                $sql .= 'OR `'.$key.'` LIKE "%'.$text.'%" ';
            }
                
            $sql .= ') ';
        }

        $sql .= ($calc_distance?'HAVING distance < 15':''); // Within 10km

        $sql .= ' ORDER BY rating DESC;';

        global $pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(!$arr) return false;
        return $arr;
    }


    function save_rating($restaurant_id,$rating,$review) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO `4ww3`.`reviews` (`restaurant_id`,`rating`,`review`,`user_id`) VALUES (?, ?, ?, ?)");
        $stmt->execute([$restaurant_id, $rating, $review, auth_get_user_id()]);
        return $pdo->lastInsertId();
    }

    function get_ratings($restaurant_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT r.*,u.name FROM reviews r JOIN users u ON r.user_id = u.id  WHERE restaurant_id = ? ORDER BY date_submitted DESC");
        $stmt->execute([$restaurant_id]);
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(!$arr) return [];
        return $arr;
    }

    function update_restaurant_rating($restaurant_id) {
        global $pdo;

        $stmt = $pdo->prepare("SELECT SUM(rating)/count(*) as rating FROM reviews WHERE restaurant_id = ?");
        $stmt->execute([$restaurant_id]);
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($arr[0]['rating'])) {
            $stmt = $pdo->prepare("UPDATE `restaurants` SET `rating` = ? WHERE `id` = ?");
            $stmt->execute([round($arr[0]['rating']), $restaurant_id]);
        }
    }

