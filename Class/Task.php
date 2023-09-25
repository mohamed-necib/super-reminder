<?php
require_once "Bdd.php";

class Task extends BDD {

    private ?pdo $bdd;
    
    public function __construct()
    {
        $this->bdd = $this->getPDO();
    }

    public function createTask(string $title, string $description, int $user_id): string
    {
        $title = trim(htmlspecialchars($title));
        $description = trim(htmlspecialchars($description));

        $sql = "INSERT INTO Tasks (title, description, date, user_id) VALUES (:title, :description, NOW, :user_id)";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute([
            ":title" => $title,
            ":description" => $description,
            ":user_id" => $user_id
        ]);
        if ($stmt->rowCount() > 0) {
            return "ok";
        } else {
            return "nop";
        }
    }

    public function getTasks(int $user_id): array
    {
        $sql = "SELECT * FROM Tasks WHERE user_id = :user_id ORDER BY date DESC";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute([":user_id" => $user_id]);
        $datas = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $datas;
    }

    public function deleteTask(int $id): string
    {
        $sql = "DELETE FROM Tasks WHERE id = :id";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute([":id" => $id]);
        if ($stmt->rowCount() > 0) {
            return "ok";
        } else {
            return "nop";
        }
    }

    public function FinishTask(int $id): string
    {
        $sql = "UPDATE Tasks SET finish = 1 WHERE id = :id";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute([":id" => $id]);
        if ($stmt->rowCount() > 0) {
            return "ok";
        } else {
            return "nop";
        }
    }

    


}