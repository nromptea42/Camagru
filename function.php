<?php

  function checkUser($pdo, $email)
  {
    $query = $pdo->prepare("SELECT * FROM users WHERE email = '".$email."'");
    $query->execute();
    $user = $query->fetchAll();
    if ($user[email] == $email) {
      return (1);
    }
    return (0);
  }
  // function checkAdmin($mysqli, $id)
  // {
  //   $query = mysqli_query($mysqli, "SELECT * FROM users WHERE id = '".$id."'");
  //   $user = mysqli_fetch_array($query);
  //   if ($user[group] == "admin") {
  //     return (1);
  //   }
  //   return (0);
  // }

  function getName($pdo, $id)
  {
    $query = $pdo->prepare("SELECT * FROM users WHERE id = '".$id."'");
    $query->execute();
    $user = $query->fetchAll();
    if ($user) {
      return $user[name];
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
?>