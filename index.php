<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Super Reminder</title>
</head>

<body>
  <?php if (isset($_SESSION["user"])) : ?>
    <header class="title-header">
      <h3>Bonjour <?= $_SESSION["user"]->firstname ?> <?= $_SESSION["user"]->lastname ?></h3>
      <button class="todocta" id='deconnect'>Déconnexion</button>
    </header>
  <?php endif ?>

  <div class="container">
    <?php if (isset($_SESSION["user"])) : ?>
      <div class="todolist">
        <?php require_once './components/todolist.php'; ?>
      </div>
      <script src="./Js/deconnect.js"></script>
    <?php else : ?>
      <div class="wrapper">

        <div class="register">
          <?php require_once './components/register.php'; ?>
        </div>

        <div class="signin">
          <?php require_once './components/signin.php'; ?>
        </div>

        <div class="switch-container">
          <span class="switch" id="spanSwitch">Pas encore inscrit?</span><button id="switch" class="link">S'inscrire</button>
        </div>

      </div>
    <?php endif ?>

  </div>




</body>

</html>