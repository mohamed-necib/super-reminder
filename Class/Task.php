<?php
require_once "Bdd.php";

class Task extends BDD {

  private ?int $id;
  private ?string $title;
  private ?string $date;
  private ?int $id_user;

  private ?pdo $bdd;

  public function __construct() {
    $this->bdd = $this->getPDO();
  }

  // Fonction qui permet de créer une tâche dans la base de données

  public function createTask(string $title, int $user_id): string {
    $title = trim(htmlspecialchars($title));
}
?>