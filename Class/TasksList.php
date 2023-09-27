<?php
require_once "Bdd.php";

class TasksList extends BDD
{

  private ?pdo $bdd;

  public function __construct()
  {
    $this->bdd = $this->getPDO();
  }

  // Fonction qui permet de créer une tâche dans la base de données

  public function createList(string $title, int $user_id): string
  {
    $title = trim(htmlspecialchars($title));


    $sql = "INSERT INTO Lists (title,  date, id_user) VALUES (:title, NOW(), :user_id)";
    $stmt = $this->bdd->prepare($sql);
    $stmt->execute([
      ":title" => $title,

      ":user_id" => $user_id
    ]);
    if ($stmt->rowCount() > 0) {
      return "ok";
    } else {
      return "nop";
    }
  }

  // Fonction qui permet de récupérer les tâches dans la base de données

  public function getLists(int $user_id): array
  {
    $sql = "SELECT * FROM Lists WHERE id_user = :user_id ORDER BY date DESC";
    $stmt = $this->bdd->prepare($sql);
    $stmt->execute([":user_id" => $user_id]);
    $datas = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $datas;
  }

  // Fonction qui permet de supprimer une tâche dans la base de données

  public function deleteList(int $id): string
  {
    $sql = "DELETE FROM Lists WHERE id = :id";
    $stmt = $this->bdd->prepare($sql);
    $stmt->execute([":id" => $id]);
    if ($stmt->rowCount() > 0) {
      return "ok";
    } else {
      return "nop";
    }
  }

  // Fonction qui permet de changer l'état de la tâche dans la base de données

  public function FinishList(int $id, int $done): string
  {

    $sql = "UPDATE Lists SET finish = :done WHERE id = :id";
    $stmt = $this->bdd->prepare($sql);
    $stmt->execute(
      [
        ":id" => $id,
        ":done" => $done
      ]
    );
    if ($stmt->rowCount() > 0) {
      return "ok";
    } else {
      return "nop";
    }
  }
}
