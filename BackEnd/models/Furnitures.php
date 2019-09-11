<?php
    class Furnitures {
        //DB Stuff
        private $conn;
        private $table = 'furnitures';

        //Post Properties
        public $id;
        public $name;
        public $quantity;
        public $status;
        public $date;
        public $did;

        public function __construct($db){
            $this->conn = $db;
        }

        public function create(){
            //Create query
            $query = "INSERT INTO $this->table SET id = NULL, name = :name, quantity = :quantity, did = :did";
           
            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean Data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->quantity = htmlspecialchars(strip_tags($this->quantity));
            $this->did = htmlspecialchars(strip_tags($this->did));

            //Bind Data
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':quantity', $this->quantity);
            $stmt->bindParam(':did', $this->did);

            //Execute Query
            if ($stmt->execute()){
                return true;
            }

            return false;
        }

        public function read(){
            $query = "SELECT id, name, quantity, status, date, did FROM $this->table";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function delete(){
            //Create query
            $query = "DELETE FROM $this->table WHERE id = :id AND status = 'Pending'";
            
            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean Data
            $this->id = htmlspecialchars(strip_tags($this->id));
            
            //Bind Data
            $stmt->bindParam(':id', $this->id);
            
            //Execute Query
            if ($stmt->execute()){
                return true;
            }

            //Print error if something goes wrong
            //printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }
?>