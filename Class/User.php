<?php

require_once "Bdd.php";
class User extends BDD
{
  private ?int $id;
  private ?string $login;
  private ?string $firstname;
  private ?string $lastname;
  private ?string $password;

  private ?pdo $bdd;

  public function __construct()
  {
    $this->bdd = $this->getPDO();
  }

  //fonction permettant de créer un utilisateur en BDD

  public function createUser(string $login, string $firstname, string $lastname, string $password, string $password_confirm): string
  {

    $login = trim(htmlspecialchars($login));
    $firstname = trim(htmlspecialchars($firstname));
    $lastname = trim(htmlspecialchars($lastname));
    $password = trim(htmlspecialchars($password));


    if ($password != $password_confirm) {
      return "Les mots de passe ne correspondent pas";
    }
    if ($this->loginVerification($login)) {
      return "Ce login est déjà utilisé";
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO Users (login, firstname, lastname, password) VALUES (:login, :firstname, :lastname, :password)";
    $stmt = $this->bdd->prepare($sql);
    $stmt->execute([
      ":login" => $login,
      ":firstname" => $firstname,
      ":lastname" => $lastname,
      ":password" => $password
    ]);
    if ($stmt->rowCount() > 0) {
      return "ok";
    } else {
      return "nop";
    }
  }

  public function loginVerification(string $login): bool
  {
    $sql = "SELECT * FROM Users WHERE login = :login";
    $stmt = $this->bdd->prepare($sql);
    $stmt->execute([":login" => $login]);
    if ($stmt->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function login(string $login, string $password): string
  {
    $login = trim(htmlspecialchars($login));
    $password = trim(htmlspecialchars($password));

    $sql = "SELECT * FROM Users WHERE login = :login";
    $stmt = $this->bdd->prepare($sql);
    $stmt->execute([":login" => $login]);
    $user = $stmt->fetch(PDO::FETCH_OBJ);
    if ($user) {
      if (password_verify($password, $user->password)) {
        $_SESSION["user"] = $user;
        return "ok";
      } else {
        return "L'un des champs est incorrect";
      }
    } else {
      return "L'un des champs est incorrect";
    }
  }

  public function logout(): void
  {
    session_destroy();
    
  }
}
