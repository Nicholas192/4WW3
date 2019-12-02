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
        return ($id?$arr[0]:$arr);
    }