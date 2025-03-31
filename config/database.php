<?php
class Database {
    private $host = "127.0.0.1"; // Agregar host correcto
    private $port = "3307"; // Agregar puerto Correcto
    private $db_name = "catalog";
    private $username = "root";
    private $password = ""; 
    public $conn;

    public function connect() {
        $this->conn = null;
        
        try {
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->db_name};charset=utf8mb4";
            $this->conn = new PDO($dsn, $this->username, $this->password);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }

        return $this->conn;
    }
}
