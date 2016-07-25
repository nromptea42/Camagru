<?php

  function checkEmail($pdo, $email)
  {
    $query = $pdo->prepare("SELECT * FROM users WHERE email = '".$email."'");
    $query->execute();
    $user = $query->fetchAll();
    if ($user[0][email] == $email) {
      return (1);
    }
    return (0);
  }

  function checkLogin($pdo, $login)
  {
    $query = $pdo->prepare("SELECT * FROM users WHERE login = '".$login."'");
    $query->execute();
    $user = $query->fetchAll();
    if ($user[0][login] == $login) {
      return (1);
    }
    return (0);
  }

  function getName($pdo, $id)
  {
    $query = $pdo->prepare("SELECT * FROM users WHERE id = '".$id."'");
    $query->execute();
    $user = $query->fetchAll();
    if ($user) {
      return $user[0][name];
    }
    return (NULL);
  }

  function getUser($pdo, $id)
  {
    $query = $pdo->prepare("SELECT * FROM users WHERE id = '".$id."'");
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
?>