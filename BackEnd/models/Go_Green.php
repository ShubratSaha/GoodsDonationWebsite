<?php
    class Go_Green  {
        //DB Stuff
        private $conn;
        private $table = 'go_green';

        //Post Properties
        public $id;
        public $name;
        public $email;
        public $tree_type;

        public function __construct($db){
            $this->conn = $db;
        }

        public function create(){
            //Create query
            $query = "INSERT INTO $this->table SET id = NULL, name = :name, email = :email, tree_type = :tree_type";
           
            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean Data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->tree_type = htmlspecialchars(strip_tags($this->tree_type));

            //Bind Data
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':tree_type', $this->tree_type);

            //Execute Query
            if ($stmt->execute()){
                return true;
            }

            return false;
        }
    }
?>