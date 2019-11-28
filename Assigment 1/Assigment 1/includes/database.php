<?php

    $dsn = "mysql:host=localhost;dbname=mydb";
    $user = "user12";
    $passwd = "12user";

    $pdo = new PDO($dsn, $user, $passwd);

    function create_login($name,$email,$password,$pic_path,$marketing) {
      $stmt = $pdo->prepare("INSERT INTO users (name,email,password,pic_path,marketing) VALUES (?, ?, ?, ?, ?)");
      $stmt->execute([$name,$email,$password,$pic_path,$marketing]);
      return $pdo->lastInsertId();
    }

    function check_login($email,$password) {
      $password = sha1($passwd.'upupdowndownleftrightleftright'.$passwd.'ABABSelectStart');
      $stmt = $pdo->prepare("SELECT * FROM users WHERE email=? AND password=? ");
      $stmt->execute([$email,$password]);
      $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
      if(!$arr) return false;
      return $arr[0]['id'];
    }

    function create_restaurant($name,$address,$phone,$lat,$long,$pic_path,$description) {
      $stmt = $pdo->prepare("INSERT INTO restaurants (name,address,phone,lat,long,pic_path,description) VALUES (?, ?)");
      $stmt->execute([$name,$address,$phone,$lat,$long,$pic_path,$description]);
      return $pdo->lastInsertId();
    }

    function search_restaurant() {
      $password = sha1($passwd.'upupdowndownleftrightleftright'.$passwd.'ABABSelectStart');
      $stmt = $pdo->prepare("SELECT * FROM users WHERE email=? AND password=? ");
      $stmt->execute([$email,$password]);
      return $stmt->rowCount() == 1;
    }
