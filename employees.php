<?php
    class Employee{
        // Connection
        private $conn;
        // Table
        private $db_table = "Employee";
        // Columns
        public $id;
        public $nama;
        public $telepon;
        public $laptop;
        public $status;
        public $created;
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getEmployees(){
            $sqlQuery = "SELECT id, nama, telepon, laptop, status, created FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        // CREATE
        public function createEmployee(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        nama = :nama, 
                        telepon = :telepon, 
                        laptop = :laptop, 
                        status = :status, 
                        created = :created";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->nama=htmlspecialchars(strip_tags($this->nama));
            $this->telepon=htmlspecialchars(strip_tags($this->telepon));
            $this->laptop=htmlspecialchars(strip_tags($this->laptop));
            $this->status=htmlspecialchars(strip_tags($this->status));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":nama", $this->nama);
            $stmt->bindParam(":telepon", $this->telepon);
            $stmt->bindParam(":laptop", $this->laptop);
            $stmt->bindParam(":status", $this->status);
            $stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // READ single
        public function getSingleEmployee(){
            $sqlQuery = "SELECT
                        id, 
                        nama, 
                        telepon, 
                        laptop, 
                        status, 
                        created
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->nama = $dataRow['nama'];
            $this->telepon = $dataRow['telepon'];
            $this->laptop = $dataRow['laptop'];
            $this->status = $dataRow['status'];
            $this->created = $dataRow['created'];
        }        
        // UPDATE
        public function updateEmployee(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        nama = :nama, 
                        telepon = :telepon, 
                        laptop = :laptop, 
                        status = :status, 
                        created = :created
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->nama=htmlspecialchars(strip_tags($this->nama));
            $this->telepon=htmlspecialchars(strip_tags($this->telepon));
            $this->laptop=htmlspecialchars(strip_tags($this->laptop));
            $this->status=htmlspecialchars(strip_tags($this->status));
            $this->created=htmlspecialchars(strip_tags($this->created));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":nama", $this->nama);
            $stmt->bindParam(":telepon", $this->telepon);
            $stmt->bindParam(":laptop", $this->laptop);
            $stmt->bindParam(":status", $this->status);
            $stmt->bindParam(":created", $this->created);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // DELETE
        function deleteEmployee(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>
