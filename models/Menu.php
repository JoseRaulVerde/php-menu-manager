<?php
require_once './config/database.php';
require_once './helpers/Validator.php';


class Menu {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Obtiene todos los menús, incluyendo el nombre del menú padre si existe
    public function getAllMenus() {
        if (!$this->conn) {
            die("Conexión a la base de datos fallida.");
        }

        $query = "SELECT 
            m1.*, 
            m2.name AS parent_name 
        FROM menus m1
        LEFT JOIN menus m2 ON m1.parent_menu_id = m2.id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtencion de padres
    public function getMenusWithChildren() {
        $query = "
            SELECT DISTINCT m2.*
            FROM menus m1
            JOIN menus m2 ON m1.parent_menu_id = m2.id
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtiene los submenús por ID de menú padre
    public function getChildrenByParent($id){
        $query = "SELECT * FROM menus WHERE parent_menu_id = ? ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtiene los menús que no tienen un menú padre
    public function getRootMenus() {
        $query = "SELECT * FROM menus WHERE parent_menu_id IS NULL";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtiene los menús sin padre excluyendo un ID específico 
    public function getRootMenusExcluding($id)
    {
        $query = "SELECT * FROM menus WHERE parent_menu_id IS NULL AND id != ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    // Inserta un nuevo menú
    public function addNewMenu($name, $desc, $parent) {
        if (!$this->conn) {
            die("Conexión a la base de datos fallida.");
        }
    
        $query = "INSERT INTO menus (name, description, parent_menu_id) VALUES (:name, :description, :parent)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':name' => $name,
            ':description' => $desc,
            ':parent' => $parent ?: null
        ]);
    
        return $this->conn->lastInsertId();
    }
    
    // Elimina un menú por ID
    public function deleteMenu($id) {
        if (!$this->conn) {
            die("Conexión a la base de datos fallida.");
        }
    
        $query = "DELETE FROM menus WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $id]);
    
        return $stmt->rowCount();
    }

    // Obtiene un menú por ID
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM menus WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Actualiza un menú por ID
    public function updateMenu($id, $name, $desc, $parent) {
        $stmt = $this->conn->prepare("UPDATE menus SET name = ?, description = ?, parent_menu_id = ? WHERE id = ?");
        $stmt->execute([$name, $desc, $parent ?: null, $id]);
    }
    
    
}
