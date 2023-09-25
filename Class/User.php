<?php

require_once "Bdd.php";
class User extends BDD
{


  private ?int $id;
  private ?string $login;
  private ?string $firstname;
  private ?string $lastname;
  private ?string $password;

  protected ?pdo $bdd;

  public function __construct()
  {
    
  }

  //fonction permettant de créer un utilisateur en BDD

  public function createUser(string $login, string $firstname, string $lastname, string $password, string $password_confirm): bool
  {

    $login = trim(htmlspecialchars($login));
    $firstname = trim(htmlspecialchars($firstname));
    $lastname = trim(htmlspecialchars($lastname));
    $password = trim(htmlspecialchars($password));


    if ($password != $password_confirm) {
      echo "Les mots de passe ne correspondent pas";
      return false;
    }
    if ($this->loginVerification($login)) {
      echo "Ce login est déjà utilisé";
      return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (login, firstname, lastname, password) VALUES (:login, :firstname, :lastname, :password)";
    $stmt = $this->bdd->prepare($sql);
    $stmt->execute([
      ":login" => $login,
      ":firstname" => $firstname,
      ":lastname" => $lastname,
      ":password" => $password
    ]);
    if ($stmt->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function loginVerification(string $login): bool
  {
    $sql = "SELECT * FROM user WHERE login = :login";
    $stmt = $this->bdd->prepare($sql);
    $stmt->execute([":login" => $login]);
    if ($stmt->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }
}
