<?php
require_once "Bdd.php";

class Task extends BDD {

  private ?int $id;
  private ?string $title;
  private ?string $date;
  private ?int $list_id;

  private ?pdo $bdd;

  public function __construct() {
    $this->bdd = $this->getPDO();
  }

  // Fonction qui permet de créer une tâche dans la base de données
  public function createTask(string $title, int $priority, int $list_id): string {
    $title = trim(htmlspecialchars($title));
    $list_id = trim(htmlspecialchars($list_id));

    $sql = "INSERT INTO Tasks (title, priority, date, id_list) VALUES (:title, :priority, NOW(), :list_id)";
    $stmt = $this->bdd->prepare($sql);
    $stmt->execute([
      ":title" => $title,
      ":priority" => $priority,
      ":list_id" => $list_id
    ]);
    if ($stmt->rowCount() > 0) {
      return "ok";
    } else {
      return "nop";
    }
  }

  // Fonction qui permet de récupérer les tâches dans la base de données

  public function getTasks(int $list_id): array {
    $sql = "SELECT * FROM Tasks WHERE id_list = :list_id ORDER BY priority ASC";
    $stmt = $this->bdd->prepare($sql);
    $stmt->execute([":list_id" => $list_id]);
    $datas = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $datas;

  }

  // Fonction qui permet de supprimer une tâche dans la base de données

  public function deleteTask(int $id): string {
    $sql = "DELETE FROM Tasks WHERE id = :id";
    $stmt = $this->bdd->prepare($sql);
    $stmt->execute([":id" => $id]);
    if ($stmt->rowCount() > 0) {
      return "ok";
    } else {
      return "nop";
    }
  }

  // Fonction qui permet de changer l'état de la tâche dans la base de données

  public function finishTask(int $id, int $done): string {
    $sql = "UPDATE Tasks SET finish = :done WHERE id = :id";
    $stmt = $this->bdd->prepare($sql);
    $stmt->execute([
      ":done" => $done,
      ":id" => $id
    ]);
    if ($stmt->rowCount() > 0) {
      return "ok";
    } else {
      return "nop";
    }
  }
}

  
?>