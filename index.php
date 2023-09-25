<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script defer src="./Js/register.js"></script>
  <title>Super Reminder</title>
</head>

<body>
  <?php if (isset($_SESSION["user"])){
    echo "Bonjour " . $_SESSION["user"]->firstname . " " . $_SESSION["user"]->lastname;
  }
  ?>
<div class="register">
  <?php require_once './register.php'; ?>
</div>

<div class="signin">
  <?php require_once './signin.php'; ?>
</div>

<div class="todolist">
  <?php require_once './todolist.php'; ?>
</div>




</body>

</html>