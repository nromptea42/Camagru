<?php

  function checkEmail($pdo, $email)
  {
    $query = $pdo->prepare("SELECT * FROM users WHERE email = '$pdo->quote$email'");
    $query->execute();
    $user = $query->fetchAll();
    if ($user[0][email] == $email) {
      return (1);
    }
    return (0);
  }

  function checkLogin($pdo, $login)
  {
    $query = $pdo->prepare("SELECT * FROM users WHERE login = '$pdo->quote$login'");
    $query->execute();
    $user = $query->fetchAll();
    if ($user[0][login] == $login) {
      return (1);
    }
    return (0);
  }

  function getName($pdo, $id)
  {
    $query = $pdo->prepare("SELECT * FROM users WHERE id = '$pdo->quote$id'");
    $query->execute();
    $user = $query->fetchAll();
    if ($user) {
      return $user[0][name];
    }
    return (NULL);
  }

  function getUser($pdo, $id)
  {
    $query = $pdo->prepare("SELECT * FROM users WHERE id = '$pdo->quote$id'");
    $query->execute();
    $user = $query->fetchAll();
    if ($user) {
      return $user;
    }
    return (NULL);
  }

  function readArray($array)
  {
    if (!$array)
      return ;
    foreach ($array as $key => $value) {
        echo "$value<br>";
    }
  }

  function pr($data)
  {
     echo "<pre>";
     print_r($data); // or var_dump($data);
     echo "</pre>";
  }

  function generateRandomString($length)
  {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
?>