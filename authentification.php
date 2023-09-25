<?php
require_once './Class/User.php';


   if (isset($_POST["register"])) {
        
      $login = $_POST["login"];
      $firstname = $_POST["firstname"];
      $lastname = $_POST["lastname"];
      $password = $_POST["password"];
      $password_confirm = $_POST["password_confirm"];
      $user = new User();
      $user->createUser($login, $firstname, $lastname, $password, $password_confirm);
   }
