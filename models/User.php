<?php
require 'models/Model.php';
class User extends Model {
    public function __construct(private PDO $db) {}

    public function listar(): array {
        return $this->db->query("SELECT * FROM users ORDER BY id DESC")->fetchAll();
    }

    public function obtenerPorId(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function guardar(?int $id = null): bool {
        if ($id) {
            //
            return false;
        }
        //
        return false;
    }

    public function eliminar(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }
}